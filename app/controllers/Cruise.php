<?php
class Cruise extends Controller
{
    public $model;
    public $data = [];
    public function __construct()
    {
        $this->model = new Model();
    }

    public function index($slug)
    {
        $cruise = $this->model('ShipModel')->getCruiseBySlug($slug);
        $cruiseImages = explode(',', $cruise['images']);
        // $cruiseImages = array_chunk($cruiseImages, 3);
        $cruiseFeatures = $this->model->findById('product_feature', $cruise['id'], ['icon', 'text'], [
            'features f' => 'f.id = product_feature.feature_id',
            'products p' => 'p.id = product_feature.product_id',
        ], 'product_id', true);
        $cruiseShortDescs = $this->model('ShipModel')->getCruiseShortDesc($cruise['id']);
        $cruiseLongDescs = $this->model('ShipModel')->getCruiseLongDesc($cruise['id']);
        $cruiseRooms = $this->model("ShipModel")->getCruiseRoom($cruise['id']);

        $this->data['cruise'] = $cruise;
        $this->data['cruiseImages'] = $cruiseImages;
        $this->data['cruiseFeatures'] = $cruiseFeatures;
        $this->data['cruiseShortDescs'] = array_column($cruiseShortDescs, 'description');
        $this->data['cruiseLongDescs'] = $cruiseLongDescs;
        $this->data['cruiseRooms'] = $cruiseRooms;
        $this->data['page_title'] = 'Mixivivu';
        $this->data['header'] = 'components/client/header';
        $this->data['footer'] = 'components/client/footer';
        $this->data['contents'] = [
            'frontend/cruise/index',
        ];
        $this->data['layout'] = 'frontend/layout.css';
        $this->data['styles'] = [
            'frontend/cruise/style.css',
        ];

        $this->data['scripts'] = [
            'components/toast.min.js',
            'components/toast.js',
            'frontend/cruise/main.js',
        ];

        $this->render('layouts/client_layout', data: $this->data);
    }

    public function searchPage($currentPage = 1)
    {
        $recordsPerPage = 5;
        $offset = ($currentPage - 1) * $recordsPerPage;
        $this->data['page_title'] = 'Mixivivu';
        $this->data['header'] = 'components/client/header';
        $this->data['footer'] = 'components/client/footer';
        $this->data['contents'] = [
            'frontend/cruise/SearchPage',
        ];
        $this->data['layout'] = 'frontend/layout.css';
        $this->data['styles'] = [
            'frontend/cruise/style.css',
        ];

        $this->data['scripts'] = [
            'components/toast.min.js',
            'components/toast.js',
            'frontend/cruise/searchPage.js',
        ];

        $numberPage = $this->model('ShipModel')->countPageCruise($recordsPerPage);
        $ships = $this->model('ShipModel')->getFullInfoShip($offset, $recordsPerPage);
        $this->data['ships'] = $ships;
        $this->data['features'] = $this->model('FeatureModel')->getAllFeatures();
        $this->data['countAll'] = $this->model('ShipModel')->countAllCruise();
        $this->data['numberPage'] = $numberPage;
        $this->data['recordsPerPage'] = $recordsPerPage;
        $this->data['currentPage'] = $currentPage;

        $this->render('layouts/client_layout', data: $this->data);
    }

    public function search($currentPage = 1)
    {
        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $recordsPerPage = 5;
        $offset = ($currentPage - 1) * $recordsPerPage;

        $data = [
            'keyword' => $_GET['keyword'],
            'location' => $_GET['location'],
            'price' => $_GET['price'],
        ];

        $search = $this->model('ShipModel')->searchPage($data, $offset, $recordsPerPage);

        if (empty($search['data'])) {
            $this->data['page_title'] = 'Not found';
            $this->data['href-back'] = _WEB_ROOT . '/tim-du-thuyen';
            $this->data['contents'] = [
                'components/errors/not_found'
            ];
        } else {
            $this->data['page_title'] = 'Mixivivu';
            $this->data['header'] = 'components/client/header';
            $this->data['footer'] = 'components/client/footer';
            $this->data['contents'] = [
                'frontend/cruise/SearchPage',
            ];

            $this->data['scripts'] = [
                'components/toast.min.js',
                'components/toast.js',
                'frontend/cruise/searchPage.js',
            ];

            $numberPage = ceil($search['totalRecords'] / $recordsPerPage);
            $this->data['ships'] = $search['data'];
            $this->data['countAll'] = $search['totalRecords'];
            $this->data['features'] = $this->model('FeatureModel')->getAllFeatures();
            $this->data['numberPage'] = $numberPage;
            $this->data['recordsPerPage'] = $recordsPerPage;
            $this->data['currentPage'] = $currentPage;
        }

        $this->data['layout'] = 'frontend/layout.css';
        $this->data['styles'] = [
            'frontend/cruise/style.css',
        ];

        $this->render('layouts/client_layout', data: $this->data);
    }

    public function sortWithPrice($currentPage = 1)
    {
        $sort = $_GET['sort'] ?? '';
        $recordsPerPage = 5;
        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $offset = ($currentPage - 1) * $recordsPerPage;
        $ships = $this->model("ShipModel")->sortWithPrice($sort, $offset, $recordsPerPage);
        $numberPage = $this->model('ShipModel')->countPageCruise($recordsPerPage);

        $this->data['page_title'] = 'Mixivivu';
        $this->data['header'] = 'components/client/header';
        $this->data['footer'] = 'components/client/footer';
        $this->data['contents'] = [
            'frontend/cruise/SearchPage',
        ];
        $this->data['layout'] = 'frontend/layout.css';
        $this->data['styles'] = [
            'frontend/cruise/style.css',
        ];

        $this->data['scripts'] = [
            'components/toast.min.js',
            'components/toast.js',
            'frontend/cruise/searchPage.js',
        ];

        $this->data['ships'] = $ships;
        $this->data['features'] = $this->model('FeatureModel')->getAllFeatures();
        $this->data['countAll'] = $this->model('ShipModel')->countAllCruise();
        $this->data['numberPage'] = $numberPage;
        $this->data['recordsPerPage'] = $recordsPerPage;
        $this->data['currentPage'] = $currentPage;

        $this->render('layouts/client_layout', data: $this->data);
    }

    public function sortWithCheckbox($features = null)
    {
        if ($features == null) {
            header('Location: ' . _WEB_ROOT . '/tim-du-thuyen');
        }
        $featureArr = explode(",", $features);
        $recordsPerPage = 5;
        $currentPage = 1;
        $offset = ($currentPage - 1) * $recordsPerPage;
        $ships = $this->model("ShipModel")->sortWithCheckbox($features, $offset, $recordsPerPage);
        if ($ships == false) {
            echo '
                <div class="admin-notFound">
                    <div class="card NotFound_not-found">
                        <div class="NotFound_img-wrapper">
                            <div style="width: 100%; height: 100%; position: relative; overflow: hidden;">
                                <img src="https://res.cloudinary.com/dhnp8ymxv/image/upload/v1732179000/sad_asisx9.png" alt="mixivivu" width="100%" height="100%"
                                    loading="lazy" style="object-fit: cover;">
                            </div>
                        </div>

                        <div class="flex flex-col gap-8">
                            <h5>Rất tiếc, Mixivivu không tìm thấy kết quả cho bạn</h5>
                            <p class="md" style="color: var(--gray-600, #475467);">Nhấn OK để bắt đầu tìm kiếm mới.</p>
                        </div>
                        <a href="' . _WEB_ROOT . '/tim-du-thuyen">
                            <button type="button" class="btn btn-normal btn-outline">
                                <div class="label md">OK</div>
                                <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M2.5 6H9.5M9.5 6L6.5 3M9.5 6L6.5 9" stroke="var(--gray-800, #1d2939)"
                                        stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </button>
                        </a>
                    </div>
                </div>
            ';
            return;
        }

        foreach ($ships as $ship) {
            echo '
            <a href="' . _WEB_ROOT . '/du-thuyen/' . $ship['slug'] . '">
                <div class="card ProductCard-list">
                    <div class="ProductCard-imageWrapper">
                        <div class="ProductCard-imageWrapper-image" style="width: 352px; height: 264px; position: relative; overflow: hidden;">
                            <img src="' . $ship['thumbnail'] . '" alt="Ship Thumbnail" width="100%" height="100%" loading="lazy" style="object-fit: cover;">
                        </div>
                        <div class="Badge-warning Badge-sm Badge-container ProductCard-imageWrapper-badge">
                            <label class="xs">' . $ship['score_review'] . ' (' . $ship['num_reviews'] . ') đánh giá</label>
                        </div>
                    </div>
                    <div class="ProductCard-cardContent">
                        <div class="ProductCard-body">
                            <div class="Badge-default Badge-sm Badge-container ProductCard-location">
                                <label class="xs">' . $ship['category_name'] . '</label>
                            </div>
                            <p class="ProductCard-title subheading md">' . $ship['title'] . '</p>
                            <div class="ProductCard-description">
                                <p class="sm">Hạ thuỷ ' . $ship['year'] . ' - Tàu vỏ ' . $ship['shell'] . ' - ' . $ship['cabin'] . ' phòng</p>
                            </div>
                        </div>
                        <div class="ProductCard-tags">';

            foreach ($ship['feature_texts'] as $feature) {
                echo '<div class="Badge-default Badge-sm Badge-container"><label class="xs">' . $feature . '</label></div>';
            }

            echo '</div>
                        <div class="ProductCard-footer">
                            <p class="ProductCard-price subheading md" style="color: var(--primary-dark, #0E4F4F);">' . number_format($ship['default_price']) . 'đ / khách</p>
                            <button type="button" class="btn btn-sm btn-color btn-primary">
                                <div class="label sm">Đặt ngay</div>
                            </button>
                        </div>
                    </div>
                </div>
            </a>';
        }
    }
}
