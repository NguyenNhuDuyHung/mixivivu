<?php
class News extends Controller
{
    public function index()
    {
        echo 'news';
    }
    public function category($id)
    {
        echo 'category ' . $id;
    }
}