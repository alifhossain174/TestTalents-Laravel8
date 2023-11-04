<?php

namespace App\Http\Controllers;

use App\Candidate;
use App\CandidateTestimonial;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Mail\TestimonialMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class CandidateTestimonialController extends Controller
{
    public function sendEmailRequestingTestimonial(Request $request){

        $candidateInfo = Candidate::where('slug', $request->candidate_slug)->first();
        $slug = time().str::random(10);

        CandidateTestimonial::insert([
            'candidate_id' => $candidateInfo->id,
            'candidate_name' => $request->candidate_name,
            'referee_name' => $request->referee_name,
            'email' => $request->referee_email,
            'project_type' => $request->project_type,
            'msg' => $request->msg_for_referee,
            'status' => 0,
            'slug' => $slug,
            'created_at' => Carbon::now()
        ]);

        $data = array();
        $data['candidate_email'] = $candidateInfo->email;
        $data['candidate_slug'] = $candidateInfo->slug;
        $data['referee_name'] = $request->referee_name;
        $data['candidate_name'] = $request->candidate_name;
        $data['msg'] = $request->msg_for_referee;
        $data['slug'] = $slug;
        Mail::to(trim($request->referee_email))->send(new TestimonialMail($data));

        return response()->json(['success' => 'Request Email Send Successfully.']);

    }

    public function submitTestimonialPage($slug, $candidateSlug){

        $testimonialInfo = CandidateTestimonial::where('slug',$slug)->first();
        $candidateInfo = Candidate::where('slug',$candidateSlug)->first();
        return view('frontend.submit_testimonial', compact('testimonialInfo', 'candidateInfo'));

    }

    public function submitTestimonial(Request $request){

        $testimonialSlug = $request->slug1;
        $candidateSlug = $request->slug2;
        $testimonial = $request->testimonial;
        $testimonialInfo = CandidateTestimonial::where('slug',$testimonialSlug)->first();
        if($testimonialInfo->status == 0){
            CandidateTestimonial::where('slug',$testimonialInfo->slug)->update([
                'status' => 1,
                'reply' => $testimonial,
                'updated_at' => Carbon::now()
            ]);
        }
        return back();

    }
}
