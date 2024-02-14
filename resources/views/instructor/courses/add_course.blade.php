@extends('instructor.instructor_dashboard')
@section('instructor')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Add Course</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->
        <div class="card">
            <div class="card-body p-4">
                <h5 class="mb-4">Add Course</h5>
                <form id="myForm" action="{{ route('store.course') }}" method="POST" class="row g-3"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="form-group col-md-6">
                        <label for="input1" class="form-label">Course Name</label>
                        <input type="text" class="form-control" id="course_name" name="course_name"
                            placeholder="Course Name">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="input1" class="form-label">Course Title</label>
                        <input type="text" class="form-control" id="course_title" name="course_title"
                            placeholder="Course Name">
                    </div>


                    <div class="form-group col-md-6">
                        <label for="input2" class="form-label">Course Image</label>
                        <input class="form-control" name="course_image" type="file" id="course_image">
                    </div>
                    <div class="col-md-6">
                        <img id="showImage" src="{{ url('uploads/no_image.jpg') }}" 
                            class="rounded-circle p-1 bg-primary" width="100">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="input1" class="form-label">Course Intro Video</label>
                        <input type="file" class="form-control" accept="video/mp4, video/webm" name="video"
                            placeholder="Course Name">
                    </div>
                    <div class="form-group col-md-6">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="input1" class="form-label">Course Category</label>
                        <select name="category_id" class="form-select mb-3" aria-label="Default select example">
                            <option selected="" disabled>Open this select menu</option>
                            @foreach ($categories as $cat)
                                <option value='{{ $cat->id }}'>{{ $cat->category_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="input1" class="form-label">Course Sub-Category</label>
                        <select name="subcategory_id" class="form-select mb-3" aria-label="Default select example">
                            <option></option>

                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="input1" class="form-label">Certeficate Avaliable</label>
                        <select name="certeficate" class="form-select mb-3" aria-label="Default select example">
                            <option selected="" disabled>Open this select menu</option>
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>

                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="input1" class="form-label">Course Level</label>
                        <select name="level" class="form-select mb-3" aria-label="Default select example">
                            <option selected="" disabled>Open this select menu</option>
                            <option value="Begginer">Begginer</option>
                            <option value="Middle">Middle</option>
                            <option value="Advanced">Advanced</option>

                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="input1" class="form-label">Course Price</label>
                        <input type="text" class="form-control" id="selling_price" name="selling_price"
                            placeholder="Course Price">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="input1" class="form-label">Discount Price</label>
                        <input type="text" class="form-control" id="dicount_price" name="discount_price"
                            placeholder="Discount Price">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="input1" class="form-label">Duration</label>
                        <input type="text" class="form-control" name="duration" placeholder="Duration">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="input1" class="form-label">Resources</label>
                        <input type="text" class="form-control" name="resources" placeholder="Resources">
                    </div>
                    <div class="form-group col-md-12">
                        <label for="input1" class="form-label">Course Prerequisite</label>
                        <textarea name="prerequisites" class="form-control" id="input11" placeholder="Prerequisites ..." rows="3"></textarea>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="input1" class="form-label">Course Description</label>
                        <textarea name="description" class="form-control" id="myeditorinstance" placeholder="Description ..."
                            rows="3"></textarea>
                    </div>
                    <p>Course Goals</p>
                    <!--   //////////// Goal Option Start /////////////// -->

                    <div class="row add_item">

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="goals" class="form-label"> Goals </label>
                                <input type="text" name="course_goals[]" id="goals" class="form-control"
                                    placeholder="Goals ">
                            </div>
                        </div>
                        <div class="form-group col-md-6" style="padding-top: 30px;">
                            <a class="btn btn-success addeventmore"><i class="fa fa-plus-circle"></i> Add More..</a>
                        </div>
                    </div> <!---end row-->
                    <!--   //////////// Goal Option End /////////////// -->
                    <hr>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-check">
                                <input class="form-check-input" value="1" name="bestseller" type="checkbox"
                                    value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">Best Seller</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-check">
                                <input class="form-check-input" value="1" name="featured" type="checkbox"
                                    value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">Featured</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" name="highestrated"
                                    id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">Highest Rated</label>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="col-md-12">
                <div class="d-md-flex d-grid align-items-center gap-3">
                    <button type="submit" class="btn btn-primary px-4">Save Changes</button>
                </div>
            </div>
            </form>
        </div>
    </div>
    </div>
    <!--========== Start of add multiple class with ajax ==============-->
    <div style="visibility: hidden">
        <div class="whole_extra_item_add" id="whole_extra_item_add">
            <div class="whole_extra_item_delete" id="whole_extra_item_delete">
                <div class="container mt-2">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="goals">Goals</label>
                            <input type="text" name="course_goals[]" id="goals" class="form-control"
                                placeholder="Goals  ">
                        </div>
                        <div class="form-group col-md-6" style="padding-top: 20px">
                            <span class="btn btn-success btn-sm addeventmore"><i class="fa fa-plus-circle">Add</i></span>
                            <span class="btn btn-danger btn-sm removeeventmore"><i
                                    class="fa fa-minus-circle">Remove</i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!----For Section-------->
    <script type="text/javascript">
        $(document).ready(function() {
            var counter = 0;
            $(document).on("click", ".addeventmore", function() {
                var whole_extra_item_add = $("#whole_extra_item_add").html();
                $(this).closest(".add_item").append(whole_extra_item_add);
                counter++;
            });
            $(document).on("click", ".removeeventmore", function(event) {
                $(this).closest("#whole_extra_item_delete").remove();
                counter -= 1
            });
        });
    </script>
    <!--========== End of add multiple class with ajax ==============-->
    <script type="text/javascript">
        $(document).ready(function() {
            $('select[name="category_id"]').on('change', function() {
                var category_id = $(this).val();
                if (category_id) {
                    $.ajax({
                        url: "{{ url('/subcategory/ajax') }}/" + category_id,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('select[name="subcategory_id"]').html('');
                            var d = $('select[name="subcategory_id"]').empty();
                            $.each(data, function(key, value) {
                                $('select[name="subcategory_id"]').append(
                                    '<option value="' + value.id + '">' + value
                                    .subcategory_name + '</option>');
                            });
                        },

                    });
                } else {
                    alert('danger');
                }
            });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#myForm').validate({
                rules: {
                    category_name: {
                        required: true,
                    },
                    image: {
                        required: true,
                    },

                },
                messages: {
                    category_name: {
                        required: 'Please Enter Category Name',
                    },
                    image: {
                        required: 'Please Pick Category Image',
                    },


                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                },
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#course_image').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage').attr('src', e.target.result)
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: 'textarea#myeditorinstance', // Replace this CSS selector to match the placeholder element for TinyMCE
            plugins: 'powerpaste advcode table lists checklist',
            toolbar: 'undo redo | blocks| bold italic | bullist numlist checklist | code | table'
        });
    </script>
@endsection
