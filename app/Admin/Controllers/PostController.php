<?php

namespace App\Admin\Controllers;

use App\Handlers\ImageUploadHandler;
use App\Models\Category;
use App\Models\Post;

use App\Models\User;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Illuminate\Http\Request;

class PostController extends Controller
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

            $content->header(trans('admin.post'));
            $content->description(trans('admin.list'));

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

            $content->header(trans('admin.post'));
            $content->description(trans('admin.edit'));

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

            $content->header(trans('admin.post'));
            $content->description(trans('admin.create'));

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
        return Admin::grid(Post::class, function (Grid $grid) {

            $grid->id('ID')->sortable();
            $grid->column('title',trans('admin.title'));
            $grid->user()->name('作者');
            $grid->category()->name('分类');

            $grid->created_at(trans('admin.created_at'));
            $grid->updated_at(trans('admin.updated_at'));
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(Post::class, function (Form $form) {

            $form->display('id', 'ID');
            $form->text('title',trans('admin.title'));
            $form->select('user_id',trans('admin.author'))->options(function($id) {
                $user = User::find($id);
                if ($user) {
                    return [$user->id => $user->name];
                }
            })->ajax('/admin/api/users');
            $form->select('category_id',trans('admin.category'))->options(function($id) {
                $category = Category::find($id);
                if ($category) {
                    return [$category->id => $category->name];
                }
            })->ajax('/admin/api/categories');

            //$form->simditor('body',trans('admin.body'));
            $form->editor('body',trans('admin.body'));

            $form->display('created_at', trans('admin.created_at'));
            $form->display('updated_at', trans('admin.updated_at'));
        });
    }


    public function users(Request $request)
    {
        $q = $request->get('q');

        return User::where('name', 'like', "%$q%")->paginate(null, ['id', 'name as text']);
    }

    public function categories(Request $request)
    {
        $q = $request->get('q');

        return Category::where('name', 'like', "%$q%")->paginate(null, ['id', 'name as text']);
    }
    //编辑器图片上传
    public function uploadImage(Request $request,ImageUploadHandler $uploader)
    {
        //初始化返回数据，默认是失败
        $data = [
            'errno'   =>  '',
            'data' => '',
        ];
        //判断是否有上传文件，并赋值给$FILE
        if($files=$request->files) {
            foreach($files as $file){
                $result[] = $uploader->save($file,'post',Admin::user()->id,362);
            }
            //保存图片到本地
            if($result){
                $data['data']   =   $result;
                $data['errno']  =  0;

            }
        }
        return $data;
    }
}
