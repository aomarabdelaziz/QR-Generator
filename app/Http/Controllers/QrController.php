<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Spatie\Color\Hex;

class QrController extends Controller
{
    public function index()
    {

            return view('qr_codes.builder');
    }

    public function build(Request $request)
    {
        $validator = $request->validate(
            [
                'name' => ['required'],
                'body' => ['required']
            ]);


        $qr_size = $request->qr_size ?? 300;
        $qr_type = $request->qr_type;
        $qr_correction = $request->qr_correction ?? 'H';
        $qr_encoding = $request->qr_encoding ?? 'UTF-8';


        $name = $request->name;
        $code = Str::slug($name) . '.' . $qr_type;
        $qr_attachment = $request->qr_attachment ?? 'no';
        $body = $request->body;

        $qr_eye = $request->qr_eye ?? 'square';
        $qr_margin = $request->qr_margin ?? '0';
        $qr_style = $request->qr_style ?? 'square';
        $qr_color = Hex::fromString($request->qr_color ?? '#000000')->toRgb();

        $qr_background_color = Hex::fromString($request->qr_background_color ?? '#FFFFFF')->toRgb();
        $qr_background_color_transparent = $request->qr_background_color_transparent ?? '0';


        $qr_eye_color_inner_0 = Hex::fromString($request->qr_eye_color_inner_0 ?? '#000000')->toRgb();
        $qr_eye_color_outer_0 = Hex::fromString($request->qr_eye_color_outer_0 ?? '#000000')->toRgb();
        $qr_eye_color_inner_1 = Hex::fromString($request->qr_eye_color_inner_1 ?? '#000000')->toRgb();
        $qr_eye_color_outer_1 = Hex::fromString($request->qr_eye_color_outer_1 ?? '#000000')->toRgb();
        $qr_eye_color_inner_2 = Hex::fromString($request->qr_eye_color_inner_2 ?? '#000000')->toRgb();
        $qr_eye_color_outer_2 = Hex::fromString($request->qr_eye_color_outer_2 ?? '#000000')->toRgb();

        $qr_gradient_start = Hex::fromString($request->qr_gradient_start ?? '#000000')->toRgb();
        $qr_gradient_end = Hex::fromString($request->qr_gradient_end ?? '#000000')->toRgb();
        $qr_gradient_type = $request->qr_gradient_type ?? 'vertical';

      $QR_DATA =   QrCode::size($qr_size)
            ->size($qr_size)
            ->format($qr_type)
            ->errorCorrection($qr_correction)
            ->encoding($qr_encoding)
            ->eye($qr_eye)
            ->margin($qr_margin)
            ->style($qr_style)
            ->color($qr_color->red() , $qr_color->green() ,$qr_color->blue())
            ->backgroundColor($qr_background_color->red() , $qr_background_color->green() ,$qr_background_color->blue() ,$qr_background_color_transparent )
            ->eyeColor(0 ,
                $qr_eye_color_inner_0->red() ,
                $qr_eye_color_inner_0->green() ,
                $qr_eye_color_inner_0->blue(),
                $qr_eye_color_outer_0->red(),
                $qr_eye_color_outer_0->green(),
                $qr_eye_color_outer_0->blue())
            ->eyeColor(1 ,
                $qr_eye_color_inner_1->red() ,
                $qr_eye_color_inner_1->green() ,
                $qr_eye_color_inner_1->blue(),
                $qr_eye_color_outer_1->red(),
                $qr_eye_color_outer_1->green(),
                $qr_eye_color_outer_1->blue())
            ->eyeColor(2 ,
                $qr_eye_color_inner_2->red() ,
                $qr_eye_color_inner_2->green() ,
                $qr_eye_color_inner_2->blue(),
                $qr_eye_color_outer_2->red(),
                $qr_eye_color_outer_2->green(),
                $qr_eye_color_outer_2->blue())
            ->gradient(
                $qr_gradient_start->red(), $qr_gradient_start->green(), $qr_gradient_start->blue(),
                $qr_gradient_end->red(), $qr_gradient_end->green(), $qr_gradient_end->blue(),
                $qr_gradient_type);

        if ($qr_attachment == 'yes') {
            $QR_DATA->merge('../public/mindscms.png', .2, true);
        }

        $QR_DATA->generate($body, '../public/qr_code/'. $code );



        return back()->with([
           'status' => 'QR Code generatd successfully',
            'code' => $code
        ]);
    }

    public function phone()
    {
        return view('qr_codes.qr_phone');
    }

    public function email()
    {
        return view('qr_codes.qr_email');
    }

    public function geo()
    {
        return view('qr_codes.qr_geo');
    }

    public function sms()
    {
        return view('qr_codes.qr_sms');
    }
}
