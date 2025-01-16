 <!-- Modal -->
 <div class="modal fade" id="create_customer" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
     <div class="modal-dialog modal-lg modal-dialog-center" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title">Create Customer</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <form id="create_customer_form" method="POST" enctype="multipart/form-data">
                 @csrf
                 <div class="modal-body">
                     <div class="col-12">
                         <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
                             @foreach (json_decode($language, true) as $lang)
                                 @if ($lang['status'] == 1)
                                     <li class="nav-item">
                                         <a class="nav-link text-capitalize {{ $lang['code'] == $default_lang ? 'active' : '' }}"
                                             id="lang_{{ $lang['code'] }}-tab" data-toggle="pill"
                                             href="#lang_{{ $lang['code'] }}" data-lang="{{ $lang['code'] }}"
                                             role="tab" aria-controls="lang_{{ $lang['code'] }}"
                                             aria-selected="false">{{ \App\helpers\AppHelper::get_language_name($lang['name']) . '(' . strtoupper($lang['code']) . ')' }}</a>
                                     </li>
                                 @endif
                             @endforeach
                         </ul>
                         <div class="tab-content" id="custom-content-below-tabContent">
                             @foreach (json_decode($language, true) as $key => $lang)
                                 @if ($lang['status'] == 1)
                                     <div class="tab-pane fade {{ $lang['code'] == $default_lang ? 'show active' : '' }} mt-3"
                                         id="lang_{{ $lang['code'] }}" role="tabpanel"
                                         aria-labelledby="lang_{{ $lang['code'] }}-tab">
                                         <div class="row">
                                             <div class="form-group col-md-6">
                                                 <input type="hidden" name="lang[]" value="{{ $lang['code'] }}">
                                                 <label for="first_name_{{ $lang['code'] }}"
                                                     class="required_lable">{{ __('First Name') }}({{ strtoupper($lang['code']) }})</label>
                                                 <input type="text" id="first_name_{{ $lang['code'] }}"
                                                     class="form-control @error('first_name') is-invalid @enderror"
                                                     name="first_name[]" placeholder="{{ __('First Name') }}"
                                                     value="">
                                                 @error('first_name')
                                                     <span class="invalid-feedback" role="alert">
                                                         <strong>{{ $message }}</strong>
                                                     </span>
                                                 @enderror
                                             </div>
                                             <div class="form-group col-md-6">
                                                 <input type="hidden" name="lang[]" value="{{ $lang['code'] }}">
                                                 <label for="last_name_{{ $lang['code'] }}"
                                                     class="required_lable">{{ __('Last Name') }}({{ strtoupper($lang['code']) }})</label>
                                                 <input type="text" id="last_name_{{ $lang['code'] }}"
                                                     class="form-control @error('last_name') is-invalid @enderror"
                                                     name="last_name[]" placeholder="{{ __('Last Name') }}"
                                                     value="">
                                                 @error('last_name')
                                                     <span class="invalid-feedback" role="alert">
                                                         <strong>{{ $message }}</strong>
                                                     </span>
                                                 @enderror
                                             </div>

                                             {{-- <div class="form-group col-md-12" hidden>
                                                 <label
                                                     for="description_{{ $lang['code'] }}">{{ __('Description') }}
                                                     ({{ strtoupper($lang['code']) }})
                                                 </label>
                                                 <textarea rows="4" type="text" id="description_{{ $lang['code'] }}"
                                                     class="form-control    @error('description') is-invalid @enderror" name="description[]"
                                                     placeholder="{{ __('Enter Description') }}" value=""></textarea>
                                                 @error('description')
                                                     <span class="invalid-feedback" role="alert">
                                                         <strong>{{ $message }}</strong>
                                                     </span>
                                                 @enderror
                                             </div> --}}
                                         </div>
                                     </div>
                                 @endif
                             @endforeach
                         </div>
                     </div>
                     <div class="row">
                         <div class="form-group col-md-6">
                             <label class="required_lable" for="email">{{ __('Email') }}</label>
                             <input type="email" name="email" id="email"
                                 class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}">
                             @error('email')
                                 <span class="invalid-feedback" role="alert">
                                     <strong>{{ $message }}</strong>
                                 </span>
                             @enderror
                         </div>
                         <div class="form-group col-md-6">
                             <label class="required_lable" for="phone">{{ __('Phone') }}</label>
                             <input type="phone" name="phone" id="phone"
                                 class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}">
                             @error('phone')
                                 <span class="invalid-feedback" role="alert">
                                     <strong>{{ $message }}</strong>
                                 </span>
                             @enderror
                         </div>
                         <div class="form-group col-md-6">
                             <label class="required_lable" for="dob">{{ __('Date of birth') }}</label>
                             <input type="date" name="dob" id="dob"
                                 class="form-control @error('dob') is-invalid @enderror" value="{{ old('dob') }}">
                             @error('dob')
                                 <span class="invalid-feedback" role="alert">
                                     <strong>{{ $message }}</strong>
                                 </span>
                             @enderror
                         </div>
                         <div class="form-group col-md-6">
                             <label class="required_lable" for="address">{{ __('Address') }}</label>
                             <input type="address" name="address" id="address"
                                 class="form-control @error('address') is-invalid @enderror"
                                 value="{{ old('address') }}">
                             @error('address')
                                 <span class="invalid-feedback" role="alert">
                                     <strong>{{ $message }}</strong>
                                 </span>
                             @enderror
                         </div>

                         <div class="form-group col-md-6">
                             <div class="form-group">
                                 <label for="exampleInputFile">{{ __('Image') }}</label>
                                 <div class="input-group">
                                     <div class="custom-file">
                                         <input type="hidden" name="images" class="images_hidden">
                                         <input type="file" class="custom-file-input" id="exampleInputFile"
                                             name="image" accept="image/png, image/jpeg">
                                         <label class="custom-file-label"
                                             for="exampleInputFile">{{ __('Choose file') }}</label>
                                     </div>
                                 </div>
                                 <div class="preview preview-multiple text-center border rounded mt-2"
                                     style="height: 150px">
                                     <img src="{{ asset('uploads/defualt.png') }}" alt="" height="100%">
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
                 <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                     <button type="submit" class="btn btn-primary create_customer">Save</button>
                 </div>
             </form>
         </div>
     </div>
 </div>
