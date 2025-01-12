<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Landing Page</title>
  <style>
    body {
  margin: 0;
  font-family: Arial, sans-serif;
  background: linear-gradient(to bottom right, #e0f7ff, #ffffff);
}

.navbar {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 20px 50px;
  background: white;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.navbar .logo {
  font-size: 24px;
  font-weight: bold;
  color: #007bff;
}

.navbar .menu a {
  margin: 0 15px;
  text-decoration: none;
  color: #333;
  font-size: 16px;
  position: relative;
  transition: color 0.3s ease;
}

.navbar .menu a::after {
  content: '';
  position: absolute;
  bottom: -5px;
  left: 50%;
  width: 0;
  height: 2px;
  background: #00c3ff;
  transition: width 0.3s ease, left 0.3s ease;
}

.navbar .menu a:hover {
  color: #007bff;
}

.navbar .menu a:hover::after {
  width: 100%;
  left: 0;
}

.navbar .menu .signup {
  padding: 10px 20px;
  background: #00c3ff;
  color: white;
  border-radius: 20px;
  text-decoration: none;
  transition: background 0.3s ease, transform 0.3s ease;
}

.navbar .menu .signup:hover {
  background: #007bff;
  transform: scale(1.05);
}

.hero {
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 50px;
}

.container {
  background: white;
  box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
  border-radius: 10px;
  padding: 50px;
  max-width: 1200px;
  width: 90%;
  display: flex;
  align-items: center;
  justify-content: space-between;
}

.hero-content {
  max-width: 50%;
}

.hero-content h1 {
  font-size: 36px;
  color: #2c3e50;
  margin-bottom: 20px;
}

.hero-content p {
  font-size: 16px;
  color: #555;
  margin-bottom: 20px;
}

.hero-content .btn {
  padding: 10px 20px;
  background: #00c3ff;
  color: white;
  border: none;
  border-radius: 20px;
  cursor: pointer;
  font-size: 16px;
  transition: background 0.3s ease, transform 0.3s ease;
}

.hero-content .btn:hover {
  background: #007bff;
  transform: scale(1.05);
}

.hero-image img {
  max-width: 100%;
  height: auto;
}

.header{
  display: flex;
}

.headermobile{
  display: none;
}

@media only screen and (max-width: 700px) {
  .header{
    display: none;
  }
  .headermobile{
    display: flex;
    width: 
  }
}

  </style>
</head>
<body>
  <header class="navbar" style="display: flex; justify-content: space-between;">
  <div class="shrink-0 flex items-center">
                    <a href="/">
                      <img src="/images/logo.png" class="logo" style="height: 60px; width: 60px;">
                    </a>
                </div>
    <nav class="menu">
      
      <a href="{{ route('login') }}" class="signup">Login</a>

    </nav>
  </header>
  <main class="hero">
    <div class="container" style="display: flex; flex-wrap: wrap; justify-evenly;">
      <div class="headermobile">
        <img src="/images/logo.png" class="logo" style="height: ; width: 5cm;">
      </div>
      <div class="hero-content">
        <h1>Diskusi, memecahkan masalah</h1>
        <p>Ruang Bicara Bebas, Tanpa Identitas.</p>
        
        <button onclick="window.location='{{ route('check-account') }}'" class="btn btn-primary signup">
    Get Started
</button>

      </div>
      <div class="header">
        <img src="/images/logo.png" class="logo" style="height: ; width: 5cm;">
      </div>
    </div>
  </main>
</body>
</html>