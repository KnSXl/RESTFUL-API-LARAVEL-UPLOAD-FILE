<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Http\Controllers\ResponseController;
use App\Http\Requests\StoreUpdateImageRequest;
use App\Http\Resources\ImageResource;
use Illuminate\Http\Request;

class ImageController extends ResponseController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // search filter
        $query = Image::query();
        $fields = ['id', 'file_name'];
        
        foreach ($fields as $field) {
            if ($request->has($field)) {
                $query->where($field, 'like', '%' . $request->input($field) . '%');
            }
        }    

        // No pagination
        $images = $query->get();
        return ImageResource::collection($images);

        // With pagination
        // $images = $query->paginate(15);
        // return ImageResource::collection($images);

        // More tables no pagination
        /*
            $images = $query->get();
            $variables = Variable::all();

            $imagesWithVariables = $images->map(function ($image) use ($variables) {
                $image->variable = $variables;
                return $image;
            });

            return ImageResource::collection($imagesWithVariables);
        */
        
        // More tables with pagination
        /*
            $images = $query->paginate(15);
            $variables = Variable::all();

            $images->getCollection()->transform(function ($image) use ($variables) {
                $image->variable = $variables;
                return $image;
            });

            return ImageResource::collection($images);
       */
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $image = Image::find($id);

        if (!$image) {
            return $this->sendError('Image not found', 404);
        }

        // More tables no pagination
        // $variable = Variable::all();
        // $image->variable = $variable;

        return $this->sendResponse('Image found successfully', new ImageResource($image), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUpdateImageRequest $request)
    {
        $image = $request->file('image');
        $fileName = $request->input('file_name') ?? $image->getClientOriginalName();
        $imageData = base64_encode(file_get_contents($image));

        $imageModel = Image::create([
            'file_name' => $fileName,
            'image' => 'data:image/' . $image->getClientOriginalExtension() . ';base64,' . $imageData,
        ]);

        return $this->sendResponse('Image created successfully', new ImageResource($imageModel), 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreUpdateImageRequest $request, string $id)
    {
        $image = Image::find($id);

        if (!$image) {
            return $this->sendError('Image not found', 404);
        }

        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');
            $fileName = $imageFile->getClientOriginalName();
            $imageData = base64_encode(file_get_contents($imageFile));
            $image->image = 'data:image/' . $imageFile->getClientOriginalExtension() . ';base64,' . $imageData;
        } else {
            $fileName = $image->file_name;
        }

        $image->file_name = $fileName;

        $image->save();

        return $this->sendResponse('Image updated successfully', new ImageResource($image), 200);
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $image = Image::find($id);
        
        if (!$image) {
            return $this->sendError('Image not found', 404);
        }

        $image->delete();
        
        return $this->sendResponse('Image deleted successfully', new ImageResource($image), 200);
    }
}
