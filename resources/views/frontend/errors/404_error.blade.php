<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Not Found - Krushi Marathi</title>
    @include('frontend.includes.head_script')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"> 
</head>
<body>
    <!-- Header -->
    @include('frontend.includes.head_menu')

    <div class="container my-5">
        <div class="row">
            <!-- Left Sidebar (Suggested Blogs) -->
            <aside class="col-md-4 d-none d-md-block">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">Latest Blogs</div>
                    <ul class="list-group list-group-flush" style="margin-left: unset;">
                        {{ErrorLatestBlogs()}}
                    </ul>
                </div>
            </aside>

            <!-- Main Content (404 Message) -->
            <main class="col-md-4 text-center">
                <div class="card shadow-lg p-4">
                    <h1 class="text-danger display-3">404</h1>
                    <h2 class="text-muted">Page Not Found</h2>
                    <p class="text-secondary">Sorry, the page you are looking for is not available.</p>
                    <a href="{{ url('/') }}" class="btn btn-primary">Go to Home Page →</a>
                </div>
            </main>

            <!-- Right Sidebar (Trending Blogs) -->
            <aside class="col-md-4 d-none d-md-block">
                <div class="card shadow-sm">
                    <div class="card-header bg-success text-white">Trending Blogs</div>
                    <ul class="list-group list-group-flush" style="margin-left: unset;">
                       {{ ErrorTrendingBlogs() }}
                    </ul>
                </div>
            </aside>
        </div>
    </div>

    <!-- Footer -->
    @include('frontend.includes.footer') 
</body>
</html>
