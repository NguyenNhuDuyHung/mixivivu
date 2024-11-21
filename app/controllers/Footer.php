<?php
class Footer extends Controller
{
    public $data = [];

    public function aboutUs()
    {
        $this->data['page_title'] = 'Mixivivu';
        $this->data['header'] = 'components/client/header';
        $this->data['footer'] = 'components/client/footer';
        $this->data['contents'] = [
            'frontend/footer/AboutUs',
        ];
        $this->data['layout'] = 'frontend/layout.css';
        $this->data['styles'] = [
            'frontend/footer/style.css',
        ];

        $this->render('layouts/client_layout', data: $this->data);
    }

    public function term()
    {
        $this->data['page_title'] = 'Mixivivu';
        $this->data['header'] = 'components/client/header';
        $this->data['footer'] = 'components/client/footer';
        $this->data['contents'] = [
            'frontend/footer/Term',
        ];
        $this->data['layout'] = 'frontend/layout.css';
        $this->data['styles'] = [
            'frontend/footer/style.css',
        ];

        $this->render('layouts/client_layout', data: $this->data);
    }

    public function privacy()
    {
        $this->data['page_title'] = 'Mixivivu';
        $this->data['header'] = 'components/client/header';
        $this->data['footer'] = 'components/client/footer';
        $this->data['contents'] = [
            'frontend/footer/Privacy',
        ];
        $this->data['layout'] = 'frontend/layout.css';
        $this->data['styles'] = [
            'frontend/footer/style.css',
        ];

        $this->render('layouts/client_layout', data: $this->data);
    }

    public function howtouse()
    {
        $this->data['page_title'] = 'Mixivivu';
        $this->data['header'] = 'components/client/header';
        $this->data['footer'] = 'components/client/footer';
        $this->data['contents'] = [
            'frontend/footer/HowToUse',
        ];
        $this->data['layout'] = 'frontend/layout.css';
        $this->data['styles'] = [
            'frontend/footer/style.css',
        ];

        $this->render('layouts/client_layout', data: $this->data);
    }

    public function payment()
    {
        $this->data['page_title'] = 'Mixivivu';
        $this->data['header'] = 'components/client/header';
        $this->data['footer'] = 'components/client/footer';
        $this->data['contents'] = [
            'frontend/footer/Payment',
        ];
        $this->data['layout'] = 'frontend/layout.css';
        $this->data['styles'] = [
            'frontend/footer/style.css',
        ];

        $this->render('layouts/client_layout', data: $this->data);
    }

    public function questions()
    {
        $this->data['page_title'] = 'Mixivivu';
        $this->data['header'] = 'components/client/header';
        $this->data['footer'] = 'components/client/footer';
        $this->data['contents'] = [
            'frontend/footer/Question',
        ];
        $this->data['layout'] = 'frontend/layout.css';
        $this->data['styles'] = [
            'frontend/footer/style.css',
        ];
        $this->data['scripts'] = [
            'frontend/footer/main.js',
        ];

        $this->render('layouts/client_layout', data: $this->data);
    }

    public function rules()
    {
        $this->data['page_title'] = 'Mixivivu';
        $this->data['header'] = 'components/client/header';
        $this->data['footer'] = 'components/client/footer';
        $this->data['contents'] = [
            'frontend/footer/Rules',
        ];
        $this->data['layout'] = 'frontend/layout.css';
        $this->data['styles'] = [
            'frontend/footer/style.css',
        ];
        $this->data['scripts'] = [
            'frontend/footer/main.js',
        ];

        $this->render('layouts/client_layout', data: $this->data);
    }

    public function contact()
    {
        $this->data['page_title'] = 'Mixivivu';
        $this->data['header'] = 'components/client/header';
        $this->data['footer'] = 'components/client/footer';
        $this->data['contents'] = [
            'frontend/footer/Contact',
        ];
        $this->data['layout'] = 'frontend/layout.css';
        $this->data['styles'] = [
            'frontend/footer/style.css',
        ];
        $this->data['scripts'] = [
            'frontend/footer/main.js',
        ];

        $this->render('layouts/client_layout', data: $this->data);
    }
}
