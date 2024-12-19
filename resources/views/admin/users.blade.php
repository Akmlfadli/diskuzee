<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<x-app-layout>

    <div class="py-12">
        <div class="container">
            <h1 class="text-center mb-5" style="font-size: 2rem; font-weight: bold; color: #333;">Top Trending</h1>
    
            <!-- Start of trending posts section -->
            <div class="row" style="display: flex; justify-content: space-evenly; flex-wrap: wrap;">
                @foreach ($trending as $index => $trendings)
                <div class="col-md-4 mb-4">
                    <!-- Card Design for each trending post -->
                    <div class="card shadow-sm rounded-lg">
                        <div class="card-body">
                            <h5 class="card-title text-primary">{{ $trendings->posts }}</h5>
                            
                            <!-- Display Comments Count -->
                            <p class="card-text">Deskripsi: <strong>{{ $trendings->posts }}</strong></p>
    
                            <!-- Display the number of comments for debugging -->
                            <p>Most Comments: {{ $trendings->mostcomments }}</p>
    
                            <!-- Bar Chart for number of comments -->
                            <div class="mb-3">
                                <canvas id="trendChart{{ $index }}" width="200" height="100"></canvas>
                            </div>
    
                            <a href="/posts/topic/{{ $trendings->uuid }}" class="btn btn-primary btn-sm">View Post</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    
    <!-- Adding Chart.js for diagram visualization -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <script>
        @foreach ($trending as $index => $trendings)
        // Ensure that the value is correctly passed as an integer
        var commentsCount = {{ $trendings->mostcomments }};
        
        // Debugging: Log the comments count in the browser console
        console.log("Comments Count for {{ $trendings->posts }}: " + commentsCount);
    
        var ctx{{ $index }} = document.getElementById('trendChart{{ $index }}').getContext('2d');
        var trendChart{{ $index }} = new Chart(ctx{{ $index }}, {
            type: 'bar',
            data: {
                labels: ['Comments'],
                datasets: [{
                    label: 'Number of Comments',
                    data: [commentsCount], // Use the variable that holds the correct number of comments
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
    
    

    

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900" style="display: flex; flex-wrap: wrap;">
                    <div class="container">
                        <h1 style="font-size: 1cm; margin-bottom: 20px;">Users</h1>
                  <table class="table">
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
                        @if (Auth::user()->role == "admin" && $users )

                        @foreach ($users as $user)
                        <tr>
                            <th scope="row">{{ $user->id }}</th>
                            <td><div style="height: 50px; width: 50px; background-image: url('{{ $user->profile_picture }}'); background-size: cover;"></div></td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->role }}</td>
                            <td><button class="btn" style="background-color: red;" onclick="window.location.href = '/users/delete?id={{ $user->id }}'">DELETE</button></td>
                        </tr>
                        @endforeach
                        @else
                         <?php echo "<script>window.location.href = '/home'</script>"?>
                        @endif
                            </tbody>
                          </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900" style="display: flex; flex-wrap: wrap;">
                    <div class="container">
                    <h1 style="font-size: 1cm; margin-bottom: 20px;">Reports Posts</h1>
                        <table class="table">
                            <thead>
                                <tr>
                                  <th scope="col">UUID</th>
                                  <th scope="col">Profile</th>
                                  <th scope="col">Name</th>
                                  <th scope="col">Title</th>
                                  <th scope="col">Deskripsi</th>
                                  <th scope="col">Alasan Pelapor</th>
                                </tr>
                              </thead>
                              <tbody>
                        @if (Auth::user()->role == "admin" && $users )

                        @foreach ($reports as $report)
                        <tr>
                            <th scope="row" onclick="window.location.href = '/posts/topic/{{ $report->uuid }}'" >{{ $report->uuid }}</th>
                            <td><div style="height: 50px; width: 50px; background-image: url('{{ $report->profile }}'); background-size: cover;"></div></td>
                            <td>{{ $report->name }}</td>
                            <td>{{ $report->title }}</td>
                            <td>{{ $report->deskripsi }}</td>
                            <td>{{ $report->alasan }}</td>
                            <td><button class="btn" style="background-color: red;" onclick="window.location.href = '/posts/delete?uuid={{ $report->uuid }}'">DELETE</button></td>
                        </tr>
                        @endforeach
                        @else
                         <?php echo "<script>window.location.href = '/home'</script>"?>
                        @endif
                            </tbody>
                          </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
