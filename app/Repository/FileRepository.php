<?php


namespace App\Repository;


use App\Models\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class FileRepository
{


    public function getAll(array $params):array
    {
        $files = File::query();
        if(!empty($params['comment_id'])){
            $files->where('comment_id','=',$params['comment_id']);
        }
        return $files->get()->toArray();

    }

    /**
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function getFileById($id){
        $file = File::findOrFail($id);
        if(Storage::disk('local')->exists(File::FOLDER.'/'.$file->path)){
            return $this->streamfile(Storage::disk('local')->get(File::FOLDER.'/'.$file->path), $file->mime_type);
        }
        return null;

    }

    /**
     * @param $file
     * @param $mimetype
     * @return \Illuminate\Http\Response
     */
    private function streamfile($file,$mimetype): \Illuminate\Http\Response
    {

        if($file ==  ''){
            abort(404);
        }
        $headers = ['Content-type'=>$mimetype];
        if(request()->get('d')=='true'){
            $headers['Content-Disposition'] = 'attachment';
        }
        return Response::make($file, 200, $headers);
    }

}
