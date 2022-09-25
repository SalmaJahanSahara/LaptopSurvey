<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\LaptopBrand;
use App\Models\LaptopModel;
use App\Models\ProcessorBrand;
use App\Models\ProcessorModel;
use App\Models\ProcessorGeneration;
use App\Models\GpuBrand;
use App\Models\GpuModel;
use App\Models\GpuMemory;

class BaseController extends Controller
{
    public function index()
    {
        dump(LaptopBrand::all());
        dump(LaptopModel::all());
        dump(ProcessorBrand::all());
        dump(ProcessorModel::all());
        dump(ProcessorGeneration::all());
        dump(GpuBrand::all());
        dump(GpuModel::all());
        dump(GpuMemory::all());
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

    public function filter()
    {
        $laptop_brands = LaptopBrand::all();
        $laptop_models = LaptopModel::all();
        $processor_brands = ProcessorBrand::all();
        $processor_models = ProcessorModel::leftJoin('processor_brands as pb', 'pb.id', '=', 'processor_models.p_brand_id')->select('processor_models.id as id', 'pb.p_brand', 'processor_models.p_model', )->get();
        $processor_generations = ProcessorGeneration::all();
        $gpu_brands = GpuBrand::all();
        $gpu_models = GpuModel::leftJoin('gpu_brands as gb', 'gb.id', '=', 'gpu_models.g_brand_id')->select('gpu_models.id as id', 'gb.g_brand', 'gpu_models.g_model', )->get();
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

// return $request->all();
        if($request->laptop_brand != 0)
        {
            $laptop_models = $laptop_models->where('laptop_models.brand_id', '=', $request->laptop_brand);
        }
        
        if($request->processor_brand != 0)
        {
            $laptop_models = $laptop_models->where('laptop_models.processor_brand_id', '=', $request->processor_brand);
        }
        
        if($request->processor_model != 0)
        {
            $laptop_models = $laptop_models->where('laptop_models.processor_model_id', '=', $request->processor_model);
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

    public function basic()
    {
        return view('basic');
        // return "home";
    }
}
