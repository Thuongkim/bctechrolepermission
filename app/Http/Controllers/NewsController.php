<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateNewsRequest;
use App\Http\Requests\UpdateNewsRequest;
use App\Repositories\NewsRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Validator;
use Auth;
use Flash;
use Response;
use Input;

class NewsController extends AppBaseController
{
    /** @var  NewsRepository */
    private $newsRepository;

    public function __construct(NewsRepository $newsRepo)
    {
        $this->newsRepository = $newsRepo;
    }

    /**
     * Display a listing of the News.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $news = $this->newsRepository->all();

        return view('news.index')
            ->with('news', $news);
    }

    /**
     * Show the form for creating a new News.
     *
     * @return Response
     */
    public function create()
    {
        return view('news.create');
    }

    /**
     * Store a newly created News in storage.
     *
     * @param CreateNewsRequest $request
     *
     * @return Response
     */
    public static function insertPhoto($fileName, $path, $defaultName=null, Request $request)
    {
        $photo = null;
        $file = $request->file($fileName);
        if($request->hasFile($fileName))
        {
            $destinationPath = $path;
            $extension = $file -> getClientOriginalExtension();
            $name = $file -> getClientOriginalName();
            $name = date('Y-m-d').Time().rand(11111, 99999).'.'.$extension;
            $photo = $destinationPath.'/'.$name;
            $file->move($destinationPath, $name);
        }
        else 
        {
            $photo = $defaultName;
        }
        return $photo;
    }

    public function store(CreateNewsRequest $request)
    {
         request()->validate([

            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);
        $input = $request->all();

        // if ($request->hasFile('image')) {
        //     $image  = $request->image;
        //     $ext    = pathinfo($image->getClientOriginalName(), PATHINFO_EXTENSION);
        //     $image  = \Image::make($request->image);

        //     \File::makeDirectory(config('upload.news') .  date('dm'), 0775, true, true);
        //     $timestamp = time();
        //     $image->save(config('upload.news') .  date('dm') . '/' . "_" . $timestamp . '.' .  $ext);
        //     $input['image'] = date('dm') . '/' . '_' . $timestamp . '.' .  $ext;
        // }

        $input['image'] = $this->insertPhoto('image', 'assets/media/image/images', 'no image', $request);
        $input['user_id'] = Auth::user()->id;

        $news = $this->newsRepository->create($input);

        Flash::success('News saved successfully.');

        return redirect(route('news.index'));
    }

    /**
     * Display the specified News.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $news = $this->newsRepository->find($id);

        if (empty($news)) {
            Flash::error('News not found');

            return redirect(route('news.index'));
        }

        return view('news.show')->with('news', $news);
    }

    /**
     * Show the form for editing the specified News.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $news = $this->newsRepository->find($id);

        if (empty($news)) {
            Flash::error('News not found');

            return redirect(route('news.index'));
        }

        return view('news.edit')->with('news', $news);
    }

    /**
     * Update the specified News in storage.
     *
     * @param int $id
     * @param UpdateNewsRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateNewsRequest $request)
    {
        $news = $this->newsRepository->find($id);

        if (empty($news)) {
            Flash::error('News not found');

            return redirect(route('news.index'));
        }

        $news = $this->newsRepository->update($request->all(), $id);

        Flash::success('News updated successfully.');

        return redirect(route('news.index'));
    }

    /**
     * Remove the specified News from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $news = $this->newsRepository->find($id);

        if (empty($news)) {
            Flash::error('News not found');

            return redirect(route('news.index'));
        }

        $this->newsRepository->delete($id);

        Flash::success('News deleted successfully.');

        return redirect(route('news.index'));
    }
}
