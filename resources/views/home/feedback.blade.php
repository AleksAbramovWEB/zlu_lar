@extends('layouts.app')
@section('content')
    @if($errors->any())
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">x</span>
                    </button>
                    @if($errors->first() === 'email_error') {{__('home/feedback.email_error')}}
                    @else {{($errors->first())}}
                    @endif
                </div>
            </div>
        </div>
    @endif
    @if(session('success'))
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="alert alert-success" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">x</span>
                    </button>
                    {{__("home/feedback.success")}}
                </div>
            </div>
        </div>
    @endif
     <div class="card col-lg-8 offset-lg-2 p-md-5">
         <div class="card-body">
             <h3 class="font-weight-bold text-center mb-4">{{__('home/feedback.feedback')}}</h3>
             <p class="text-justify" style="text-indent: 20px">{{__('home/feedback.text')}}</p>
             <form method="POST" action="">
                 @method("POST")
                 @csrf
                 <div class="form-group row">
                     <label for="email" class="col-sm-3 col-form-label">email</label>
                     <div class="col-sm-12">
                         <input name="email"
                                type="email"
                                class="form-control {{MainHelper::is_valid_form('email')}} "
                                id="email"
                                placeholder="email"
                                value="{{old('email')}}"
                                required
                         >
                     </div>
                 </div>
                 <div class="form-group row">
                     <label for="subject" class="col-sm-3 col-form-label">{{ __('home/feedback.subject') }}</label>
                     <div class="col-sm-12">
                         <input name="subject"
                                type="text"
                                class="form-control {{MainHelper::is_valid_form('subject')}}"
                                id="subject"
                                placeholder="{{ __('home/feedback.subject') }}"
                                value="{{old('subject')}}"
                                required
                         >
                     </div>
                 </div>
                 <div class="form-group row">
                     <label for="message" class="col-sm-3  col-form-label">{{__('home/feedback.message')}}</label>
                     <div class="col-sm-12">
                         <textarea rows="9"
                                   name="message"
                                   type="text"
                                   class="form-control {{MainHelper::is_valid_form('message')}}"
                                   id="message"
                                   placeholder="{{__('home/feedback.message')}}"
                                   required
                         >{{old('message')}}
                         </textarea>
                     </div>
                 </div>
                 <button type="submit" class="font-weight-bold btn btn-light btn-block mt-4 mb-3">{{__('home/feedback.sand')}}</button>
             </form>
         </div>
     </div>
@endsection
