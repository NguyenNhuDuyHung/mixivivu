<?php
class Blog extends Controller
{
    public $data = [];
    protected $model;
    public function __construct()
    {
        $this->model = new Model();
    }

    public function search($currentPage = 1)
    {
        $recordsPerPage = 5;
        $keyword = $_GET['keyword'] ?? '';
        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $offset = ($currentPage - 1) * $recordsPerPage;
        $this->data['page_title'] = 'Danh sách blog';
        $this->data['layout'] = 'backend/layout.css';
        $this->data['styles'] = [
            'components/toast.min.css',
            'backend/main.css',
            'backend/feature/style.css'
        ];
        $this->data['contents'] = [
            'components/admin/sidebar',
            'backend/feature/feature/index'
        ];
        $this->data['scripts'] = [
            'components/toast.min.js',
            'components/toast.js',
            'backend/feature/main.js'
        ];

        if (isset($_GET['keyword'])) {
            $searchFeature = $this->model('FeatureModel')->search($keyword, $offset, $recordsPerPage);

            if ($searchFeature === false) {
                $this->data['page_title'] = 'Not found';
                $this->data['href-back'] = _WEB_ROOT . '/backend/feature';
                $this->data['contents'] = [
                    'components/admin/sidebar',
                    'components/errors/not_found'
                ];
            } else {
                $numberPage = $this->model->countPages($recordsPerPage, 'features', $keyword, ['text']);
                $this->data['features'] = $searchFeature;
                $this->data['countAll'] = $this->model->countAllOrByKeyword('features', $keyword, ['text']);
                $this->data['numberPage'] = $numberPage;
            }
        }

        $this->data['recordsPerPage'] = $recordsPerPage;
        $this->data['currentPage'] = $currentPage;
        $this->render('layouts/admin_layout', $this->data);
    }

    public function index($currentPage = 1)
    {
        $recordsPerPage = 5;
        $offset = ($currentPage - 1) * $recordsPerPage;
        $this->data['page_title'] = 'Danh sách blog';
        $this->data['layout'] = 'backend/layout.css';
        $this->data['styles'] = [
            'components/toast.min.css',
            'backend/main.css',
        ];
        $this->data['contents'] = [
            'components/admin/sidebar',
            'backend/blog/index'
        ];
        $this->data['scripts'] = [
            'components/toast.min.js',
            'components/toast.js',
        ];

        $numberPage = $this->model->countPages($recordsPerPage, 'blog');
        $this->data['blogs'] = $this->model('BlogModel')->pagination($offset, $recordsPerPage);

        $this->data['countAll'] = $this->model->countAllOrByKeyword('blog');
        $this->data['numberPage'] = $numberPage;

        $this->data['recordsPerPage'] = $recordsPerPage;
        $this->data['currentPage'] = $currentPage;

        $this->render('layouts/admin_layout', $this->data);
    }

    public function create()
    {
        $blogTypes = $this->model('BlogModel')->getBlogType();
        $this->data['type_blogs'] = $blogTypes;
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $title = $_POST['title'];
            $shortDesc = $_POST['short_desc'];
            $slug = $_POST['slug'];
            $typeBlog = $_POST['type_blog'];
            $create = $this->model('BlogModel')->createBlog();
            if ($create) {
                header('Location: ' . _WEB_ROOT . '/backend/blog');
            }

            $this->data['title'] = $title;
            $this->data['short_desc'] = $shortDesc;
            $this->data['slug'] = $slug;
            $this->data['type_blog'] = $typeBlog;
        }

        $this->data['page_title'] = 'Tạo blog';
        $this->data['layout'] = 'backend/layout.css';
        $this->data['styles'] = [
            'components/toast.min.css',
            'backend/main.css',
        ];
        $this->data['contents'] = [
            'components/admin/sidebar',
            'backend/blog/create'
        ];
        $this->data['scripts'] = [
            'components/toast.min.js',
            'components/toast.js',
            'backend/blog/thumbnail.js',
            'backend/blog/main.js'
        ];

        $this->render('layouts/admin_layout', $this->data);
    }

    public function update($id = 0)
    {
        if (empty($id)) {
            header('Location: ' . _WEB_ROOT . '/backend/blog');
        }

        $blogTypes = $this->model('BlogModel')->getBlogType();
        $this->data['type_blogs'] = $blogTypes;
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $title = $_POST['title'];
            $shortDesc = $_POST['short_desc'];
            $slug = $_POST['slug'];
            $typeBlog = $_POST['type_blog'];

            $update = $this->model('BlogModel')->updateBlog($id);
            if ($update) {
                header('Location: ' . _WEB_ROOT . '/backend/blog');
            }

            $this->data['title'] = $title;
            $this->data['short_desc'] = $shortDesc;
            $this->data['slug'] = $slug;
            $this->data['type_blog'] = $typeBlog;
        }

        $blog = $this->model('BlogModel')->getBlogById($id);
        $this->data['blog'] = $blog;

        if (!empty($this->data['blog']['thumbnail'])) {
            $_FILES['thumbnail'][] = $this->data['blog']['thumbnail'];
        }

        $this->data['page_title'] = 'Cập nhật thông tin của blog';
        $this->data['layout'] = 'backend/layout.css';
        $this->data['styles'] = [
            'components/toast.min.css',
            'backend/main.css',
            'backend/feature/style.css',
        ];
        $this->data['contents'] = [
            'components/admin/sidebar',
            'backend/blog/update'
        ];
        $this->data['scripts'] = [
            'components/toast.min.js',
            'components/toast.js',
            'backend/blog/thumbnail.js',
            'backend/blog/main.js'
        ];
        $this->render('layouts/admin_layout', data: $this->data);
    }

    public function updateLongDesc($id)
    {
        if (empty($id)) {
            header('Location: ' . _WEB_ROOT . '/backend/blog');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $update = $this->model('BlogModel')->updateLongDesc($id);
            if ($update) {
                header('Location: ' . _WEB_ROOT . '/backend/blog/update/' . $id);
            }
        }
        $longDescs = $this->model->findById('long_desc_blog', $id, ['*'], [], 'blog_id', true);
        $this->data['descriptions'] = $longDescs;

        $this->data['blog_id'] = $id;
        $this->data['page_title'] = 'Cập nhật mô tả chi tiết của blog';
        $this->data['layout'] = 'backend/layout.css';
        $this->data['styles'] = [
            'components/toast.min.css',
            'backend/main.css',
            'backend/feature/style.css',
        ];
        $this->data['contents'] = [
            'components/admin/sidebar',
            'backend/blog/updateLongDesc'
        ];
        $this->data['scripts'] = [
            'components/toast.min.js',
            'components/toast.js',
            'backend/blog/main.js',
            'backend/blog/longDescUpdate.js'
        ];
        $this->render('layouts/admin_layout', data: $this->data);
    }

    public function delete($id = 0)
    {
        if (empty($id)) {
            header('Location: ' . _WEB_ROOT . '/backend/blog');
        }

        $this->data['blog'] = $this->model->findById('blog', $id);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $delete = $this->model('BlogModel')->deleteBlog($id);
            if ($delete) {
                header('Location: ' . _WEB_ROOT . '/backend/blog');
            }
        }

        $this->data['page_title'] = 'Xóa blog';
        $this->data['layout'] = 'backend/layout.css';
        $this->data['styles'] = [
            'components/toast.min.css',
            'backend/main.css',
        ];
        $this->data['contents'] = [
            'components/admin/sidebar',
            'backend/blog/delete'
        ];
        $this->data['scripts'] = [
            'components/toast.min.js',
            'components/toast.js',
        ];
        $this->render('layouts/admin_layout', data: $this->data);
    }
}
