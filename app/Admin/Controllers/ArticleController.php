<?php

namespace App\Admin\Controllers;

use App\Models\Article;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class ArticleController extends Controller
{
    use ModelForm;

    /**
     * Index interface.
     *
     * @return Content
     */
    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header('Article List');
            $content->description('markdown article');

            $content->body($this->grid());
        });
    }

    /**
     * Edit interface.
     *
     * @param $id
     * @return Content
     */
    public function edit($id)
    {
        return Admin::content(function (Content $content) use ($id) {

            $content->header('Article List');
            $content->description('markdown article');

            $content->body($this->form()->edit($id));
        });
    }

    /**
     * Create interface.
     *
     * @return Content
     */
    public function create()
    {
        return Admin::content(function (Content $content) {

            $content->header('Orderable articles');
            $content->description('description');

            $content->body($this->form());
        });
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Admin::grid(Article::class, function (Grid $grid) {

            $grid->model()->with('hasManyTag')->with(['hasManyCate' => function ($query) {
                $query->with('belongsToCategory');
            }])->orderBy('id', 'desc');

            $grid->id('ID')->sortable();

            $grid->title()->editable();
            $grid->url()->editable();
            // $grid->description()->display(function ($description) {
            //     return str_replace([config('article.description.prefix'), config('article.description.suffix')], '', $description);
            // })->editable();
            // $grid->keywords()->editable();
            $grid->weight()->editable();
            $grid->like()->editable();
            // $grid->file_name()->editable();
            $grid->status()->editable();
            $grid->column('tags')->display(function () {
                $data = [];
                foreach ($this->hasManyTag as $key => $val) {
                    $data[] = '<span class="label label-success">' . $val['tag_name'] . '</span>';
                }
                return implode(' ', $data);
            });

            $grid->column('categories')->display(function () {
                $data = [];
                foreach ($this->hasManyCate as $key => $val) {
                    $data[] = '<span class="label label-success">' . $val['belongsToCategory']['name'] . '</span>';
                }
                return implode(' ', $data);
            });

            $grid->created_at();
            $grid->updated_at();
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(Article::class, function (Form $form) {

            $form->display('id', 'ID');

            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');
        });
    }
}
