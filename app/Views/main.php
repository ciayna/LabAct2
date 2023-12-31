<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Music Player</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
    body {
         font-family: Arial, sans-serif;
         text-align: center;
         background-color: #f5f5f5;
         padding: 20px;
     }

     h1 {
         color: #333;
     }

     #player-container {
         max-width: 400px;
         margin: 0 auto;
         padding: 20px;
         background-color: #fff;
         box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
     }

     audio {
         width: 100%;
     }

     #playlist {
         list-style: none;
         padding: 0;
     }

     #playlist li {
         cursor: pointer;
         padding: 10px;
         background-color: #eee;
         margin: 5px 0;
         transition: background-color 0.2s ease-in-out;
     }

     #playlist li:hover {
         background-color: #ddd;
     }

     #playlist li.active {
         background-color: #007bff;
         color: #fff;
     }

     
     #playlist1 {
         list-style: none;
         padding: 0;
     }

     #playlist1 li {
         cursor: pointer;
         padding: 10px;
         background-color: #eee;
         margin: 5px 0;
         transition: background-color 0.2s ease-in-out;
     }

     #playlist1 li:hover {
         background-color: #ddd;
     }

     #playlist1 li.active {
         background-color: #007bff;
         color: #fff;
         
     }

    .delete-button {
        display: inline-block;
        padding:8px 15px; 
        background-color: #0d6efd; 
        color: white; 
        text-decoration: none;
        border-radius: 5px;
    }

    .delete-button:hover {
        background-color: #0a58ca; 
        transition: 0.3s;
    }

    .delete-button:active {
        background-color: #0d6efd; 
    }
</style>

    </style>
</head>
<body>

<!-- This is for the add music -->
<div class="modal fade" id="addAudio" tabindex="-1" aria-labelledby="addAudioLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addAudioLabel">Add Audio</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <form action="/addAudio" method="post" enctype="multipart/form-data">
          <div class="mb-3">
            <input type="file" value="" class="form-control" id="audio_file" name="audio" accept="audio/*">
          </div>
      </div>

      <div class="modal-footer">
      <button type="submit" class="btn btn-primary">Upload</button>
      </form>
      </div>
    </div>
  </div>
</div>

<!-- This is for the add music to playlist -->
<div class="modal fade" id="addToPlaylist" tabindex="-1" aria-labelledby="addToPlaylistLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addToPlaylistLabel">Select from Playlist</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="/addToPlaylist" method="post" enctype="multipart/form-data">
          <div class="mb-3">
          <select class="form-control" name="playlistId" id="playlistIdSelect">
            <option value="">Select from Playlist</option>
            <?php foreach ($playlists as $playli): ?>
              <option value="<?= $playli['playlistId'] ?>">
                <?= $playli['playlistName'] ?>
              </option>
            <?php endforeach; ?>
          </select>

          </div>
          <input type="hidden" id="playlistIdget" name="audioId" value="">
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary" id="addToPlaylistModalSubmit">Add</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- This is for the create new playlist -->
<div class="modal fade" id="createPlaylist" tabindex="-1" aria-labelledby="createPlaylistLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="createPlaylistLabel">Create Playlist</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <form action="/addPlaylist" method='post'>
          <div class="mb-3">
            <input type="text" class="form-control" id="playlistName" name="playlistName" value="<?php ['playlistName']?>" placeholder="playlist name">
          </div>
      </div>

      <div class="modal-footer">
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Back</button>
      <button type="submit" class="btn btn-primary">Create</button>
      </form>
      </div>
    </div>
  </div>
</div>


  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Playlist</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <?php foreach($playlists as $playli): ?>
          <ul id="playlist1">
                <li><?= $playli['playlistName'] ?> 
                     <a href="/delete/<?= $playli['playlistId'] ?>" class="delete-button"> 
                      -
                    </a>
                </li>
              <?php endforeach; ?>
          </ul>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createPlaylist">Create New</button>
        </div>
      </div>
    </div>
  </div>
  <form action="/" method="get">
    <input type="search" name="search" placeholder="search song">
    <button type="submit" class="btn btn-primary">search</button>
  </form>
    <h1>Music Player</h1>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
  My Playlist
</button>

<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addAudio">Add Audio</button>
  <audio id="audio" controls autoplay></audio>
  <ul id="playlist">
      <?php foreach ($allAudio as $audio): ?>
        <li data-src='<?php echo base_url("music/" . $audio['audio']); ?>'>
          <?= $audio['audio'] ?>
            <button type="button" class="btn btn-primary add-to-playlist" data-bs-toggle="modal" data-bs-target="#addToPlaylist" >
              +
            </button>
        </li>
      <?php endforeach; ?>
  </ul>

    <div class="modal" id="myModal">
      <div class="modal-dialog">
        <div class="modal-content">

          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Select from playlist</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>

          <!-- Modal body -->
          <div class="modal-body">
          <form action="/" method="post">
            <!-- <p id="modalData"></p> -->
            <input type="hidden" id="musicID" name="musicID">
            <select  name="playlist" class="form-control" >

              <option value="playlist">playlist</option>

            </select>
            <input type="submit" name="add">
            </form>
          </div>

          <!-- Modal footer -->
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
          </div>

        </div>
      </div>
    </div>
    <script>
    $(document).ready(function () {
  // Get references to the button and modal
  const modal = $("#myModal");
  const modalData = $("#modalData");
  const musicID = $("#musicID");
  // Function to open the modal with the specified data
  function openModalWithData(dataId) {
    // Set the data inside the modal content
    modalData.text("Data ID: " + dataId);
    musicID.val(dataId);
    // Display the modal
    modal.css("display", "block");
  }

  // Add click event listeners to all open modal buttons

  // When the user clicks the close button or outside the modal, close it
  modal.click(function (event) {
    if (event.target === modal[0] || $(event.target).hasClass("close")) {
      modal.css("display", "none");
    }
  });
});
    </script>
    <script>
        const audio = document.getElementById('audio');
        const playlist = document.getElementById('playlist');
        const playlistItems = playlist.querySelectorAll('li');

        let currentTrack = 0;

        function playTrack(trackIndex) {
            if (trackIndex >= 0 && trackIndex < playlistItems.length) {
                const track = playlistItems[trackIndex];
                const trackSrc = track.getAttribute('data-src');
                audio.src = trackSrc;
                audio.play();
                currentTrack = trackIndex;
            }
        }

        function nextTrack() {
            currentTrack = (currentTrack + 1) % playlistItems.length;
            playTrack(currentTrack);
        }

        function previousTrack() {
            currentTrack = (currentTrack - 1 + playlistItems.length) % playlistItems.length;
            playTrack(currentTrack);
        }

        playlistItems.forEach((item, index) => {
            item.addEventListener('click', () => {
                playTrack(index);
            });
        });

        audio.addEventListener('ended', () => {
            nextTrack();
        });

        playTrack(currentTrack);
    </script>


    <script>
    $(document).ready(function () {
      const addToPlaylistModal = $("#addToPlaylist");
      const playlistInput = $("#playlistIdget");
      const playlistIdSelect = $("#playlistIdSelect");

      $("#addToPlaylistModalSubmit").click(function () {
      const playli = playlistIdSelect.val();
      playlistInput.val(playli);
      });
    });
    </script>
</body>
</html>
