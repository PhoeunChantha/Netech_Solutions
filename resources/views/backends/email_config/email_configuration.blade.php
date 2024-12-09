@extends('backends.master')
@section('contents')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ __('Edit Email Config') }}</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <form action="{{ route('admin.update-email-configuraion') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">{{ __('admin.Mail Host') }}</label>
                                    <input type="text" name="mail_host" value="{{ $email->mail_host ?? '' }}"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">{{ __('admin.Email') }}</label>
                                    <input type="email" name="email" value="{{ $email->email ?? '' }}"
                                        class="form-control">
                                </div>

                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">{{ __('admin.SMTP User Name') }}</label>
                                    <input type="text" name="smtp_username" value="{{ $email->smtp_username ?? '' }}"
                                        class="form-control">
                                </div>
                            </div>



                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">{{ __('admin.SMTP Password') }}</label>
                                    <input type="text" name="smtp_password" value="{{ $email->smtp_password ?? '' }}"
                                        class="form-control">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="mail_port">{{ __('admin.Mail Port') }}</label>
                                    <input type="text" name="mail_port" value="{{ $email->mail_port ?? '' }}"
                                        class="form-control" id="mail_port">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="mail_encryption">{{ __('admin.Mail Encryption') }}</label>
                                    <select name="mail_encryption" id="mail_encryption" class="form-control">
                                        <option {{ $email->mail_encryption ?? '' == 'tls' ? 'selected' : '' }}
                                            value="tls">{{ __('admin.TLS') }}</option>
                                        <option {{ $email->mail_encryption ?? '' == 'ssl' ? 'selected' : '' }}
                                            value="ssl">{{ __('admin.SSL') }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success">{{ __('admin.Update') }}</button>
                    </form>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
@endsection
