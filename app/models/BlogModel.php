<?php
class BlogModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function search($keyword, $offset, $recordsPerPage)
    {
        $sql = "SELECT p.id, p.title, COUNT(ld.id) AS countDesc
        FROM products p
        JOIN long_desc ld ON p.id = ld.product_id
        WHERE p.title LIKE '%" . $keyword . "%'
        GROUP BY p.id   
        LIMIT " . $offset . ", " . $recordsPerPage . " ";

        $data = $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        if (empty($data)) {
            return false;
        }
        return $data;
    }

    public function pagination($offset, $recordsPerPage)
    {
        $sql = "SELECT * FROM blog LIMIT " . $offset . ", " . $recordsPerPage . " ";

        $data = $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function getBlogType()
    {
        $sql = "SELECT * FROM blog_type";
        $data = $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function getBlogById($id)
    {
        $sql = "SELECT b.id, b.title, b.short_desc, b.slug, b.thumbnail, bt.type AS type_name FROM blog b JOIN blog_type bt ON bt.id = b.type WHERE b.id = " . $id;
        $data = $this->db->query($sql)->fetch(PDO::FETCH_ASSOC);
        return $data;
    }

    public function createBlog()
    {
        if ($this->isPost()) {
            $filterAll = $this->filter();

            switch ($filterAll['type_blog']) {
                case 'ship':
                    $typeBlog = 1;
                    break;
                case 'travel':
                    $typeBlog = 2;
                    break;
                case 'hotel':
                    $typeBlog = 3;
                    break;
            }

            $thumbTargetDir = 'public/img/thumbnail/' . $filterAll['slug'] . '/';
            $thumbUrl = $this->uploadImageToCloudinary($thumbTargetDir, 'thumbnail', 'thumbnail', true);


            $data = [
                'title' => $filterAll['title'],
                'short_desc' => $filterAll['short_desc'],
                'slug' => $filterAll['slug'],
                'type' => $typeBlog,
                'thumbnail' => $thumbUrl,
                'created_at' => date('Y-m-d'),
            ];

            try {
                $check = $this->checkRecord(
                    'blog',
                    ['slug'],
                    [$data['slug']],
                    null,
                    ['slug' => 'Đã tồn tại slug!']
                );
                if (!$check) {
                    $this->setSession('toast-error', 'Đã tồn tại slug!');
                    return false;
                }

                $create = $this->db->insert('blog', $data);
                if (!$create) {
                    $this->setSession('toast-error', 'Thêm không thành công! Vui lòng thử lại sau!');
                    return false;
                }
                $this->setSession('toast-success', 'Thêm thành công!');
                return true;
            } catch (Exception $e) {
                echo $e->getMessage();
                return false;
            }
        }
    }

    public function updateBlog($id)
    {
        if ($this->isPost()) {
            $filterAll = $this->filter();

            switch ($filterAll['type_blog']) {
                case 'ship':
                    $typeBlog = 1;
                    break;
                case 'travel':
                    $typeBlog = 2;
                    break;
                case 'hotel':
                    $typeBlog = 3;
                    break;
            }

            $thumbTargetDir = 'public/img/thumbnail/' . $filterAll['slug'] . '/';
            $thumbnailBlog = $this->findById('blog', $id, ['thumbnail']);

            if (empty($_FILES['thumbnail']['name'][0])) {
                $thumbUrl = $thumbnailBlog['thumbnail'];
            } else {
                $thumbUrl = $this->uploadImageToCloudinary($thumbTargetDir, 'thumbnail', 'thumbnail', true);
            }


            $data = [
                'title' => $filterAll['title'],
                'short_desc' => $filterAll['short_desc'],
                'slug' => $filterAll['slug'],
                'type' => $typeBlog,
                'thumbnail' => $thumbUrl,
                'updated_at' => date('Y-m-d'),
            ];

            try {
                $check = $this->checkRecord(
                    'blog',
                    ['slug'],
                    [$data['slug']],
                    $id,
                    ['slug' => 'Đã tồn tại slug!']
                );
                if (!$check) {
                    $this->setSession('toast-error', 'Đã tồn tại slug!');
                    return false;
                }

                $update = $this->db->update('blog', $data, 'id = ' . $id);
                if (!$update) {
                    $this->setSession('toast-error', 'Cập nhật không thành công! Vui lòng thử lại sau!');
                    return false;
                }
                $this->setSession('toast-success', 'Cập nhật thành công!');
                return true;
            } catch (Exception $e) {
                echo $e->getMessage();
                return false;
            }
        }
    }

    public function updateLongDesc($id)
    {
        if ($this->isPost()) {
            if (!isset($_POST['text'])) {
                return false;
            }

            $filterAll = $this->filter();
            $getImages = array_values(array_filter(array_column($this->findById('long_desc_blog', $id, ['image_url'], [], 'blog_id', true), 'image_url')));
            $getTexts = array_column($this->findById('long_desc_blog', $id, ['text'], [], 'blog_id', true), 'text');

            $blog = $this->getBlogById($id);
            $imageTargetDir = 'public/img/long-desc/blog/' . $blog['slug'] . '/';
            $imageUrls = $this->uploadImageToCloudinary($imageTargetDir, 'image',  $blog['slug']);

            $data = [
                'blog_id' => $id,
                'text' => !array_filter($getTexts) ? $filterAll['text'] : array_merge($filterAll['text'], $getTexts),
                'type' => $filterAll['type'],
                'image_url' => array_merge($getImages, $imageUrls),
            ];

            $insertData = [];

            // Vị trí của các phần tử trong mảng image_url và text
            $imageIndex = 0;
            $textIndex = 0;

            foreach ($data['type'] as $typeValue) {
                $record = [
                    'blog_id' => $data['blog_id'],
                    'type' => $typeValue,
                    'created_at' => date('Y-m-d H:i:s')
                ];

                // Kiểm tra type để xác định thêm text hoặc image_url
                if ($typeValue == 4 || $typeValue == 2) {
                    // Với type = 1 hoặc 2, chỉ thêm text
                    $record['text'] = isset($data['text'][$textIndex]) ? $data['text'][$textIndex] : null;
                    $record['image_url'] = null;
                    $textIndex++; // Tăng textIndex để lấy text tiếp theo
                } elseif ($typeValue == 3) {
                    // Với type = 3, chỉ thêm image_url nếu còn trong mảng image_url
                    $record['image_url'] = isset($data['image_url'][$imageIndex]) ? $data['image_url'][$imageIndex] : null;
                    $record['text'] = null;
                    $imageIndex++; // Tăng imageIndex để lấy ảnh tiếp theo cho lần duyệt sau
                }

                // Thêm bản ghi đã hoàn thiện vào mảng insertData
                $insertData[] = $record;
            }

            try {
                $clear = $this->db->delete('long_desc_blog', 'blog_id = ' . $id);
                if (!$clear) {
                    $this->setSession('toast-error', 'Có lỗi! Vui lòng thử lại sau!');
                    return false;
                }
                foreach ($insertData as $key => $value) {
                    $create = $this->db->insert('long_desc_blog', $value);
                }
                if (!$create) {
                    $this->setSession('toast-error', 'Thêm không thành công! Vui lòng thử lại sau!');
                    return false;
                }
                $this->setSession('toast-success', 'Thêm thành công!');
                return true;
            } catch (Exception $e) {
                echo $e->getMessage();
                return false;
            }
        }
    }

    public function deleteBlog($id)
    {
        try {
            $delete = $this->db->delete('blog', 'id = ' . $id);
            if (!$delete) {
                $this->setSession('toast-error', 'Xóa không thành công! Vui lòng thử lại sau!');
                return false;
            }
            $this->setSession('toast-success', 'Xóa thành công!');
            return true;
        } catch (Exception $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function getAllBlog($recordsPerPage, $offset)
    {
        $sql = "SELECT b.id, b.title, b.short_desc, b.slug, b.thumbnail, b.created_at, bt.type AS type_name FROM blog b JOIN blog_type bt ON bt.id = b.type ORDER BY b.id ASC LIMIT " . $offset . ", " . $recordsPerPage;
        $data = $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function getBlogBySlug($slug)
    {
        $sql = "SELECT b.id, b.title, b.short_desc, b.slug, b.thumbnail, b.created_at, b.short_desc, bt.type AS type_name 
        FROM blog b 
        JOIN blog_type bt ON bt.id = b.type 
        WHERE b.slug = '" . $slug . "' LIMIT 1";
        $data = $this->db->query($sql)->fetch(PDO::FETCH_ASSOC);
        return $data;
    }

    public function getLongDescBlog($id)
    {
        $sql = "SELECT * FROM long_desc_blog WHERE blog_id = " . $id;
        $data = $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function getBlogByType($type)
    {
        switch ($type) {
            case 'ship':
                $type = 1;
                break;
            case 'travel':
                $type = 2;
                break;
            case 'hotel':
                $type = 3;
                break;
        }
        $sql = "SELECT b.id, b.title, b.short_desc, b.slug, b.thumbnail, b.created_at, bt.type AS type_name FROM blog b JOIN blog_type bt ON bt.id = b.type WHERE b.type = " . $type . " LIMIT 3";
        $data = $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
}
