<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<x-app-layout>

    <div class="py-12">
        <div class="container">
            <h1 class="text-center mb-5" style="font-size: 2rem; font-weight: bold; color: #333; text-transform: uppercase;">Top Trending</h1>

            <!-- Start of trending posts section -->
            <div class="row g-4" style="display: flex; justify-content: space-evenly; flex-wrap: wrap;">
                @foreach ($trending as $index => $trendings)
                @if ($trendings->posts != "")
                <div class="col-md-4 mb-4">
                    <!-- Card Design for each trending post -->
                    <div class="card shadow-lg rounded-lg hover-shadow">
                        <div class="card-body">

                            <!-- Display Comments Count -->
                            <p class="card-text text-muted">Title: <strong>{{ $trendings->posts }}</strong></p>

                            <!-- Display the number of comments for debugging -->
                            <p class="text-muted">Post By: {{ $trendings->postauthor }}</p>
                            <p class="text-muted">Comments: {{ $trendings->mostcomments }}</p>

                            <!-- Bar Chart for number of comments -->
                            <div class="mb-3">
                                <canvas id="trendChart{{ $index }}" width="200" height="100"></canvas>
                            </div>

                            <a href="/posts/topic/{{ $trendings->uuid }}" class="btn btn-primary btn-sm">View Post</a>
                        </div>
                    </div>
                </div>
                @else
                @endif
                @endforeach
            </div>
        </div>
    </div>

    <!-- Adding Chart.js for diagram visualization -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        @foreach ($trending as $index => $trendings)
        var commentsCount = {{ $trendings->mostcomments }};
        console.log("Comments Count for {{ $trendings->posts }}: " + commentsCount);

        var ctx{{ $index }} = document.getElementById('trendChart{{ $index }}').getContext('2d');
        var trendChart{{ $index }} = new Chart(ctx{{ $index }}, {
            type: 'bar',
            data: {
                labels: ['Comments'],
                datasets: [{
                    label: 'Number of Comments',
                    data: [commentsCount],
                    backgroundColor: ['rgba(54, 162, 235, 0.2)'],
                    borderColor: ['rgba(54, 162, 235, 1)'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 10
                        }
                    }
                }
            }
        });
        @endforeach
    </script>

    <!-- Users Section -->
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900" style="display: flex; flex-wrap: wrap;">
                    <div class="container">
                        <h1 class="text-center mb-4" style="font-size: 1.5rem; text-transform: uppercase;">Users</h1>
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Profile</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Handle</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (Auth::user()->role == "admin")
                                @foreach ($users as $user)
                                @if ($user->name != "Admin")
                                <tr>
                                    <th scope="row">{{ $user->id }}</th>
                                    <td>
                                        <div style="height: 50px; width: 50px; background-image: url('{{ $user->profile_picture }}'); background-size: cover; border-radius: 50%;"></div>
                                    </td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->role }}</td>
                                    <td><button class="btn btn-danger" onclick="window.location.href = '/users/delete?id={{ $user->id }}'">DELETE</button></td>
                                </tr>
                                @endif
                                @endforeach
                                @else
                                <script>window.location.href = '/home'</script>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Reports Section -->
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900" style="display: flex; flex-wrap: wrap;">
                <div class="container">
                    <h1 class="text-center mb-4" style="font-size: 1.5rem; text-transform: uppercase;">Reported Posts</h1>

                    <!-- Responsive View for Mobile (Stacked Cards) -->
                    <div>
                    <div style="display: flex; flex-wrap: wrap; justify-content: space-evenly;">
                        @foreach ($reports as $report)
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-3">
                                        <div style="height: 50px; width: 50px; background-image: url('{{ $report->profile }}'); background-size: cover; border-radius: 50%;"></div>
                                    </div>
                                    <div class="col-9">
                                        <p><strong>Name:</strong> {{ $report->name }}</p>
                                        <p><strong>Title:</strong> {{ $report->title }}</p>
                                        <p><strong>Description:</strong> {{ $report->deskripsi }}</p>
                                        <p><strong>Reason:</strong> {{ $report->alasan }}</p>
                                        <a href="/posts/topic/{{ $report->uuid }}" class="btn btn-primary btn-sm">View Post</a>
                                        <button class="btn btn-danger btn-sm" onclick="window.location.href = '/posts/delete?uuid={{ $report->uuid }}&image1={{ $report->image1 }}&image2={{ $report->image2 }}&image3={{ $report->image3 }}'">DELETE</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


</x-app-layout>

<!-- Styling for hover effects and tables -->
<style>
    .hover-shadow:hover {
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
    }

    .card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card:hover {
        transform: scale(1.03);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .table-bordered th, .table-bordered td {
        border: 1px solid #ddd !important;
    }

    .table-striped tbody tr:nth-child(odd) {
        background-color: #f9f9f9;
    }

    .btn-danger {
        background-color: #ff4747;
        border: none;
        transition: background-color 0.3s ease;
    }

    .btn-danger:hover {
        background-color: #ff1f1f;
    }
</style>

