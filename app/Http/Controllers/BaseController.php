<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Artisan;

use App\Models\LaptopBrand;
use App\Models\LaptopModel;
use App\Models\ProcessorBrand;
use App\Models\ProcessorModel;
use App\Models\ProcessorGeneration;
use App\Models\GpuBrand;
use App\Models\GpuModel;
use App\Models\GpuMemory;
use App\Models\User;
use App\Models\UserSelection;
use App\Models\UserModelSelection;

class BaseController extends Controller
{
    public function index()
    {
        $us = UserSelection::select('ram')->get();
        foreach(json_decode($us) as $u)
        {
            $a = json_decode($u->ram);
            $i = 1;
            if($a != null)
            {
                foreach($a as $a1)
                { 
                    if($i != 1)
                    {
                        echo ", ";
                        
                    }$i++;
                    echo $a1;
                }
            }
            else{echo "Not Available";}
            echo "<br>";
        }
    }

    public function insert()
    {
        $laptop_brands = LaptopBrand::all();
        $laptop_models = LaptopModel::all();
        $processor_brands = ProcessorBrand::all();
        $processor_models = ProcessorModel::all();
        $processor_generations = ProcessorGeneration::all();
        $gpu_brands = GpuBrand::all();
        $gpu_models = GpuModel::all();
        $gpu_memories = GpuMemory::all();

        return view('insertLaptop', compact('laptop_brands', 'laptop_models', 'processor_brands', 'processor_models', 'processor_generations', 'gpu_brands', 'gpu_models', 'gpu_memories'));
    }

    public function basic()
    {
        return view('basic');
    }

    public function basicSubmit(Request $request)
    {

        $request->validate([
            'user_name' => 'required | string',
            'age' => 'required | numeric | min:10 | max:100',
            'gender' => 'required | string',
            'profession' => 'required | string',
            'type' => 'required | string',
            'level' => 'required | string'
        ], [
            'user_name.required' => 'Name is Required !',
            'user_name.string' => 'Name must be a string !',

            'age.required' => 'Age is Required !',
            'age.numeric' => 'Age must be an integer !',
            'age.min' => 'Babies are not allowed!',
            'age.max' => 'Grandpa! Take rest.',
            
            'gender.required' => 'Gender is Required !',
            'gender.string' => 'Gender must be a string !',
            
            'profession.required' => 'Profession is Required !',
            'profession.string' => 'Profession must be a string !',
            
            'type.required' => 'Type is Required !',
            'type.string' => 'Type must be a string !',
            
            'level.required' => 'Level is Required !',
            'level.string' => 'Level must be a string !',
        ]);

        $user = new User();
        $user->user_name = $request->user_name;
        $user->age = $request->age;
        $user->gender = $request->gender;
        $user->profession = $request->profession;
        $user->type = $request->type;
        $user->level = $request->level;
        $user->note = $request->note;
        $user->save();
        
        session()->put('user_id', $user->id);
        session()->put('user_name', $user->user_name);

        return redirect(route('filter'));
    }

    public function filter()
    {
        $laptop_brands = LaptopBrand::all();
        $laptop_models = LaptopModel::all();
        $processor_brands = ProcessorBrand::all();
        $processor_models = ProcessorModel::leftJoin('processor_brands as pb', 'pb.id', '=', 'processor_models.p_brand_id')->select('processor_models.id as id', 'pb.p_brand', 'processor_models.p_model', )->orderBy('pb.id')->get();
        $processor_generations = ProcessorGeneration::all();
        $gpu_brands = GpuBrand::all();
        $gpu_models = GpuModel::leftJoin('gpu_brands as gb', 'gb.id', '=', 'gpu_models.g_brand_id')->select('gpu_models.id as id', 'gb.g_brand', 'gpu_models.g_model', )->orderBy('gb.id')->get();
        $gpu_memories = GpuMemory::all();

        return view('filterLaptop', compact('laptop_brands', 'laptop_models', 'processor_brands', 'processor_models', 'processor_generations', 'gpu_brands', 'gpu_models', 'gpu_memories'));
    }

    public function filterSubmit(Request $request)
    {
        $laptop_models = LaptopModel::leftJoin('laptop_brands as lb', 'lb.id', '=', 'laptop_models.brand_id')
        ->leftJoin('processor_brands as pb', 'pb.id', '=', 'laptop_models.processor_brand_id')
        ->leftJoin('processor_models as pm', 'pm.id', '=', 'laptop_models.processor_model_id')
        ->leftJoin('processor_generations as pg', 'pg.id', '=', 'laptop_models.processor_generation_id')
        ->leftJoin('gpu_brands as gb', 'gb.id', '=', 'laptop_models.gpu_brand_id')
        ->leftJoin('gpu_models as gm', 'gm.id', '=', 'laptop_models.gpu_model_id')
        ->leftJoin('gpu_memories as gmm', 'gmm.id', '=', 'laptop_models.gpu_memory_id');

        if($request->laptop_brand != 0)
        {
            $laptop_models = $laptop_models->where('laptop_models.brand_id', '=', $request->laptop_brand);
        }
        
        if($request->processor_model != 0)
        {
            $laptop_models = $laptop_models->where('laptop_models.processor_model_id', '=', $request->processor_model);
            $request->processor_brand = 0;
        }
        
        if($request->processor_brand != 0)
        {
            $laptop_models = $laptop_models->where('laptop_models.processor_brand_id', '=', $request->processor_brand);
        }
        
        $input = $request->all();

        if($request->ram != 0)
        {
            $laptop_models = $laptop_models->whereIn('laptop_models.ram', $request->input('ram'));
        }
        
        if($request->storage != "none")
        {
            if($request->storage == "both")
            {
                $laptop_models = $laptop_models->where('laptop_models.ssd', '>', 0)->where('laptop_models.hdd', '>', 0);
            }
            else if($request->storage == "ssd")
            {
                $laptop_models = $laptop_models->where('laptop_models.ssd', '>', 0)->where('laptop_models.hdd', '=', 0);
            }
            else if($request->storage == "hdd")
            {
                $laptop_models = $laptop_models->where('laptop_models.ssd', '=', 0)->where('laptop_models.hdd', '>', 0);
            }
        }
        
        if($request->gpu != 0)
        {
            $laptop_models = $laptop_models->where('laptop_models.gpu_model_id', '=', $request->gpu);
            $request->gpu_brand = 0;
        }
        
        if($request->gpu_brand != 0)
        {
            $laptop_models = $laptop_models->where('laptop_models.gpu_brand_id', '=', $request->gpu_brand);
        }
        
        if($request->gpu_memory != 0)
        {
            $laptop_models = $laptop_models->where('laptop_models.gpu_memory_id', '=', $request->gpu_memory);
        }
        
        if($request->disp_size != 0)
        {
            $laptop_models = $laptop_models ->where('laptop_models.display_size', '<', $request->disp_size + 0.3)
                                            ->where('laptop_models.display_size', '>', $request->disp_size - 0.3);
        }
        
        if($request->disp_quality != 0)
        {
            $laptop_models = $laptop_models->where('laptop_models.display_quality', '=', $request->disp_quality);
        }

        if($request->sf != null)
        {
            
            $sf = $request->input('sf');
            foreach($sf as $s)
            {
                $laptop_models = $laptop_models->where('laptop_models.sf', 'like', '%' . $s . '%');
            }
        }
        
        if($request->min_price != null)
        {
            $laptop_models = $laptop_models->where('laptop_models.price', '>=', $request->min_price);
        }
        
        if($request->max_price != null)
        {
            $laptop_models = $laptop_models->where('laptop_models.price', '<=', $request->max_price);
        }

        $laptop_models = $laptop_models->get();
        $total_laptop = LaptopModel::get()->count();

        if($request->laptop_brand == 0){$request->laptop_brand = null;}
        if($request->processor_brand == 0){$request->processor_brand = null;}
        if($request->processor_model == 0){$request->processor_model = null;}
        if($request->gpu == 0){$request->gpu = null;}
        if($request->gpu_memory == 0){$request->gpu_memory = null;}

        $user_selection = new UserSelection();
        $user_selection->user_id = session()->get('user_id');
        $user_selection->laptop_brand_id = $request->laptop_brand;
        $user_selection->processor_brand_id = $request->processor_brand;
        $user_selection->processor_model_id = $request->processor_model;
        $user_selection->ram = json_encode($request->input('ram'));
        $user_selection->storage = $request->storage;
        $user_selection->gpu_model_id = $request->gpu;
        $user_selection->gpu_memory_id = $request->gpu_memory;
        $user_selection->disp_size = $request->disp_size;
        $user_selection->disp_quality = $request->disp_quality;
        $user_selection->min_price = $request->min_price;
        $user_selection->max_price = $request->max_price;
        $user_selection->sf = json_encode($request->input('sf'));
        $user_selection->save();

        return view('laptops', compact('laptop_models', 'total_laptop'));
    }

    public function laptops()
    {
        
        $laptop_models = LaptopModel::leftJoin('laptop_brands as lb', 'lb.id', '=', 'laptop_models.brand_id')
        ->leftJoin('processor_brands as pb', 'pb.id', '=', 'laptop_models.processor_brand_id')
        ->leftJoin('processor_models as pm', 'pm.id', '=', 'laptop_models.processor_model_id')
        ->leftJoin('processor_generations as pg', 'pg.id', '=', 'laptop_models.processor_generation_id')
        ->leftJoin('gpu_brands as gb', 'gb.id', '=', 'laptop_models.gpu_brand_id')
        ->leftJoin('gpu_models as gm', 'gm.id', '=', 'laptop_models.gpu_model_id')
        ->leftJoin('gpu_memories as gmm', 'gmm.id', '=', 'laptop_models.gpu_memory_id')
        ->get();

        $total_laptop = LaptopModel::count();
        $processor_brands = ProcessorBrand::all();
        $processor_models = ProcessorModel::all();
        $processor_generations = ProcessorGeneration::all();
        $gpu_brands = GpuBrand::all();
        $gpu_models = GpuModel::all();
        $gpu_memories = GpuMemory::all();

        return view('laptops', compact('laptop_brands', 'laptop_models', 'processor_brands', 'processor_models', 'processor_generations', 'gpu_brands', 'gpu_models', 'gpu_memories'));
    }

    public function laptopsSubmit(Request $request)
    {
        $input = $request->all();
        $selected_laptops = $request->input('selected_laptops');

        if(is_countable($selected_laptops) && count($selected_laptops) > 0)
        {
            foreach($selected_laptops as $sl)
            {
                $user_model_selection = new UserModelSelection();
                $user_model_selection->user_id = $request->session()->get('user_id');
                $user_model_selection->model_id = $sl;
                $user_model_selection->save();
            }
        }
        else
        {
            return "<html><br><br><center><h2>Go Back and Select one or more Laptops.</h2></center></html>";
        }

        return view('finish');
    }
}
