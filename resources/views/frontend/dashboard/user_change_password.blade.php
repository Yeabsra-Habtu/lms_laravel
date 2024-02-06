@extends('frontend.dashboard.user_dashboard')
@section('userdashboard')
    <div class="media media-card align-items-center">
    </div><!-- end media -->
    <div class="tab-pane fade show active" id="edit-profile" role="tabpanel" aria-labelledby="edit-profile-tab">
        <div class="setting-body">
            <h3 class="fs-17 font-weight-semi-bold pb-4">Edit Profile</h3>
            <form method="post" action="{{ route('user.password.update') }}" enctype="multipart/form-data"
                class="row pt-40px">
                @csrf
                <div class="input-box col-lg-6">
                    <label class="label-text">Old Password</label>
                    <div class="form-group">
                        <input type="password" name="old_password" id="old_password"
                            class="form-control @error('old_password') is-invalid @enderror" />
                        @error('old_password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div><!-- end input-box -->
                <div class="input-box col-lg-6">
                    <label class="label-text">New Password</label>
                    <div class="form-group">
                        <input type="password" name="new_password" id="new_password"
                            class="form-control @error('new_password') is-invalid @enderror" />
                        @error('new_password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div><!-- end input-box -->
                <div class="input-box col-lg-6">
                    <label class="label-text">Confirm New Password</label>
                    <div class="form-group">
                        <input type="password" name="new_password_confirmation" id="new_password_confirmation"
                            class="form-control @error('new_password_confirmation') is-invalid @enderror" />
                        @error('new_password_confirmation')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div><!-- end input-box -->
                <div class="input-box col-lg-12 py-2">
                    <button type="submit" class="btn theme-btn">Save Changes</button>
                </div><!-- end input-box -->
            </form>
        </div><!-- end setting-body -->
    </div><!-- end tab-pane -->
@endsection
