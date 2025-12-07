<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Testimonial;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function userHome() {
        $testimonials = Testimonial::orderBy('created_at', 'desc')->get();
        $testimonialsJs = $testimonials->map(function ($t) {
            $initial = collect(explode(' ', $t->name))
                ->filter()
                ->take(2)
                ->map(fn ($part) => mb_substr($part, 0, 1))
                ->implode('');
            
            return [
                'text'    => $t->text,               // atau $t->testimonial
                'name'    => $t->name,
                'role'    => $t->occupation,
                'photo'   => $t->img ? asset($t->img) : null,
                'date'    => $t->created_at->translatedFormat('d F Y'),
                'initial' => \Illuminate\Support\Str::upper(substr($initial, 0, 1)),
            ];
        })->values();
        return view('user.home')->with('testimonialsJs', $testimonialsJs)->with('testimonials', $testimonials);
    }

    public function userRegisterProgram($programName) {
        $user = Auth::user();

        $nomorTujuan = '6285971823998';

        $message = "Halo Admin Govind Abra Enterprise!\n".
                   "Saya {$user->name}.\n".
                   "Ingin mendaftar program " . $programName . ".";

        $url = "https://wa.me/{$nomorTujuan}?text=" . urlencode($message);

        return redirect()->away($url);
    }

    public function userTestimonial(){
        $user = Auth::user();
        return view('user.testimonial')->with('user', $user);
    }

    public function userSubmitTestimonial(Request $request)
    {
        $data = $request->validate([
            'occupation' => 'nullable|string|max:255',
            'text'       => 'required|string',
        ]);

        $user = Auth::user();

        $imgPath = $user->img;

        $maxLength = 255;
        $data['text'] = Str::limit($data['text'], $maxLength, '');

        Testimonial::create([
            'name'       => $user->name,
            'occupation' => $data['occupation'],
            'text'       => $data['text'],
            'img'        => $imgPath
        ]);

        return redirect()->route('home')->with('success', 'Thank you for your testimonial!');
    }

    public function userSubmitContact(Request $request)
    {
        $nomorTujuan = '6285971823998';

        $message = "Halo Admin Govind Abra Enterprise, saya dengan \n".
                "Nama: {$request->get('name')}\n".
                "Email: {$request->get('email')}\n".
                "Ingin menghubungi perihal : {$request->get('message')}";

        $url = "https://wa.me/{$nomorTujuan}?text=" . urlencode($message);

        return redirect()->away($url);
    }

}
