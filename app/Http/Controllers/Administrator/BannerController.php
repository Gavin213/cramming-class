<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Requests\Administrator\BannerRequest;
use App\Models\Banner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BannerController extends Controller
{
    /**
     * 列表
     *
     * @param $type
     * @param Banner $banner
     * @param CategoryHandler $categoryHandler
     * @return mixed
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index(Request $request,Banner $banner)
    {
//        $this->authorize('index', $banner);

        $banners = $banner->ordered()->recent()->paginate(config('administrator.paginate.limit'));

        return backend_view('banner.index', compact('banners'));
    }

    /**
     * 创建
     *
     * @param $type
     * @param int $parent
     * @param Banner $banner
     * @return mixed
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create(Request $request,Banner $banner)
    {
        $this->authorize('create', $banner);

        return backend_view('banner.create_and_edit', compact('banner'));
    }

    /**
     * 保存
     *
     * @param BannerRequest $request
     * @param Banner $banner
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(BannerRequest $request,Banner $banner)
    {
        $this->authorize('create',$banner);

        $banner = Banner::create($request->all());

        return $this->redirect('banners.index')->with('success', '添加成功.');
    }

    /**
     * 编辑
     *
     * @param Banner $article
     * @return mixed
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Banner $banner)
    {
        $this->authorize('update', $banner);

        return backend_view('banner.create_and_edit',compact('banner'));
    }

    /**
     * 更新
     *
     * @param BannerRequest $request
     * @param Banner $article
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(BannerRequest $request,Banner $banner)
    {
        $this->authorize('update', $banner);

        $banner->update($request->all());

        return redirect()->route('banners.index')->with('success', '更新成功.');
    }

    /**
     * 删除
     *
     * @param Article $article
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Banner $banner)
    {
        $this->authorize('destroy', $banner);
        $banner->delete();

        return redirect()->route('banners.index')->with('success', '删除成功.');
    }


    /**
     * 排序
     *
     * @param Article $article
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function order(Banner $banner)
    {
        $this->authorize('update',$banner);
        $ids = request('id');
        $orders = request('order');

        foreach($ids as $key => $value) {
            $banner->where('id',$value)->update(['order' => $orders[$key] ?? 999 ]);
        }

        return redirect()->route('banners.index')->with('success', '操作成功.');
    }
}
