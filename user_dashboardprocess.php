<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Dashboard</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f4f4f4;
    }

    header {
      background-color: #333;
      color: #fff;
      padding: 10px;
      text-align: center;
    }

    nav {
      background-color: #ddd;
      padding: 10px;
      text-align: left;
      position: fixed;
      width: 250px;
      height: 100%;
      left: -250px;
      top: 0;
      transition: left 0.3s ease;
    }

    nav a {
      display: block;
      text-decoration: none;
      color: #333;
      padding: 10px;
      margin: 10px 0;
      border-radius: 5px;
      background-color: #fff;
    }

    section {
      padding: 20px;
      margin-left: 250px;
      transition: margin-left 0.3s ease;
    }

    #welcome-message {
      font-size: 24px;
      margin-bottom: 20px;
    }

    #user-details {
      font-size: 18px;
    }

    #menu-icon {
      font-size: 24px;
      cursor: pointer;
      position: fixed;
      left: 20px;
      top: 20px;
      z-index: 1;
    }

    label {
      font-size: 18px;
      display: block;
      margin-bottom: 5px;
    }

    #postInput {
      width: 100%;
      box-sizing: border-box;
      margin-bottom: 10px;
      padding: 8px;
      font-size: 16px;
    }

    button {
      background-color: #4CAF50;
      color: white;
      padding: 10px 15px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-size: 16px;
    }

    button:hover {
      background-color: #45a049;
    }
  </style>
</head>
<body>

  <header>
    <h1>User Dashboard</h1>
  </header>

  <div id="menu-icon" onclick="toggleNav()">🌐</div>

  <nav>
    <a href="#">Home</a>
    <a href="consultform.php">Consult</a>
    <a href="#">Feedback</a>
    <a href="#" id="profile-link">Profile</a>
    <a href="#">Settings</a>
    <a href="indexmain.php">Logout</a>
  </nav>

  <section id="content-section">
    <!-- Dynamic content will be loaded here -->
  </section>

  <script>
    document.getElementById('profile-link').addEventListener('click', function () {
      // Fetch and display user profile content dynamically
      loadUserProfile();
    });

    function loadUserProfile() {
      // Simulate fetching user data from the server
      // Replace this with actual AJAX request to your server

      // Simulated user ID (replace with actual user authentication)
      var userId = 1;

      // Build a FormData object to send data to the server
      var formData = new FormData();
      formData.append('user_id', userId);

      // Fetch user data and posts from the server using AJAX
      fetch('get_user_profile.php', {
        method: 'POST',
        body: formData
      })
      .then(response => response.json())
      .then(userData => {
        // Build user profile HTML content
        var profileContent = '<div id="profile-content">';
        profileContent += '<h2>User Profile</h2>';
        profileContent += '<p><strong>Username:</strong> ' + userData.username + '</p>';
        profileContent += '<p><strong>Email:</strong> ' + userData.email + '</p>';
        profileContent += '<h3>Posts</h3>';

        // Display user posts
        if (userData.posts.length > 0) {
          profileContent += '<ul>';
          userData.posts.forEach(function (post) {
            profileContent += '<li>' + post.content + '</li>';
          });
          profileContent += '</ul>';
        } else {
          profileContent += '<p>No posts yet.</p>';
        }

        profileContent += '</div>';

        // Display the profile content in the section
        document.getElementById('content-section').innerHTML = profileContent;
      })
      .catch(error => {
        console.error('Error fetching user profile:', error);
      });
    }

    // Your existing JavaScript code here

    function toggleNav() {
      const nav = document.querySelector('nav');
      const section = document.querySelector('section');
      if (nav.style.left === '0px') {
        nav.style.left = '-250px';
        section.style.marginLeft = '0';
      } else {
        nav.style.left = '0';
        section.style.marginLeft = '250px';
      }
    }
  </script>

</body>
</html>
