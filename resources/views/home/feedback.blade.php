@extends('layouts.app')
@section('content')
     <div class="card col-lg-8 offset-lg-2">
         <div class="card-body">
             <h3 class="font-weight-bold text-center mb-4">{{__('feedback.feedback')}}</h3>
             <p class="text-justify" style="text-indent: 20px">{{__('feedback.text')}}</p>
             <form method="POST" action="">
                 @method("POST")
                 @csrf
                 <div class="form-group row">
                     <label for="email" class="col-sm-3 col-form-label">email</label>
                     <div class="col-sm-12">
                         <input name="email" type="email" class="form-control" id="email" placeholder="email">
                     </div>
                 </div>
                 <div class="form-group row">
                     <label for="subject" class="col-sm-3 col-form-label">{{ __('feedback.subject') }}</label>
                     <div class="col-sm-12">
                         <input name="subject" type="text" class="form-control" id="subject" placeholder="{{ __('feedback.subject') }}">
                     </div>
                 </div>
                 <div class="form-group row">
                     <label for="message" class="col-sm-3  col-form-label">{{__('feedback.message')}}</label>
                     <div class="col-sm-12">
                         <textarea rows="9" name="message" type="text" class="form-control" id="message" placeholder="{{__('feedback.message')}}">
                         </textarea>
                     </div>
                 </div>
                 <button type="button" class="font-weight-bold btn btn-light btn-block mt-4 mb-3">{{__('feedback.sand')}}</button>
             </form>
         </div>
     </div>
@endsection
