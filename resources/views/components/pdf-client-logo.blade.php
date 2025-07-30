{{-- <div class="col-4 client-logo column pl-0 ml-0"> --}}
    <img class="float-left" style="width:200px; height: 100px"
         src='data:image/png;base64,
            {{
                 (!empty(auth()->user()->logo_path)
                 && \Illuminate\Support\Facades\Storage::disk('public')->exists(auth()->user()->logo_path))
                ? base64_encode(\Illuminate\Support\Facades\Storage::disk('public')->get(auth()->user()->logo_path))
                : base64_encode(file_get_contents(public_path('images/fit_test_logo_placeholder.jpeg')))
            }}'
    />
{{-- </div> --}}
