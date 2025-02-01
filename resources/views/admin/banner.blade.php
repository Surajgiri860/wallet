<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Update Banner</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .card {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            border-radius: 10px;
        }
        .img-preview {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card shadow-sm">
        <a href="javascript:history.back()" class="btn btn-secondary back-btn">← Back To Dashboard</a>
            <div class="card-body">
                <h3 class="text-center mb-4">Update Banner</h3>
                
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <form action="{{ route('admin.banner.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="mb-3">
                        <label class="form-label">Banner Title</label>
                        <input type="text" name="title" class="form-control" placeholder="Enter Banner Title" value="{{ $banner->title ?? '' }}">
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Banner Content</label>
                        <textarea name="content" class="form-control" rows="3" placeholder="Enter Banner Content">{{ $banner->content ?? '' }}</textarea>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Banner Image</label>
                        <input type="file" name="image" class="form-control" id="imageUpload">
                        <div class="text-center">
                            @if(isset($banner->image))
                                <img id="preview" src="{{ asset('storage/' . $banner->image) }}" class="img-preview">
                            @else
                                <img id="preview" class="img-preview" style="display: none;">
                            @endif
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-primary w-100">Save Banner</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('imageUpload').addEventListener('change', function(event) {
            const reader = new FileReader();
            reader.onload = function() {
                const img = document.getElementById('preview');
                img.src = reader.result;
                img.style.display = 'block';
            }
            reader.readAsDataURL(event.target.files[0]);
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
