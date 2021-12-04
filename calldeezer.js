const proxyURL = "https://severo-musicgame.herokuapp.com/";
let songs = [];
fetchSongs();
let sound = null;

function Question(song_names, prev_urls, img) {
  this.song_names = song_names;
  this.prev_urls = prev_urls;
  this.img = img;
}
function Song(name, url, album_cover) {
  this.name = name;
  this.url = url;
  this.album_cover = album_cover;
}
function fetchSongs() {
  //access values that will be used to create API query
  let artist = localStorage.getItem("artist");
  let artistChosen = artist;
  console.log(artistChosen);
  const getArtist = async () => {
    ///make call to deezer based on search
    let artist_id = "";
    axios
      .get(proxyURL + "http://api.deezer.com/search/artist?q=" + artistChosen)
      .then((response) => {
        artist_id = response.data.data[0].id;
        getAlbums(artist_id).then(loadQuestion);
      })
      .catch((err) => {
        console.log("Artist ID retrieval failed", err);
      });
  };
  getArtist();

  const getAlbums = async (artist_id, callback) => {
    return new Promise(function (resolve, reject) {
      let questions = [];

      let album_urls = [];
      axios
        .get(proxyURL + "http://api.deezer.com/artist/" + artist_id + "/albums")
        .then((response) => {
          response.data.data.forEach((album) => {
            axios
              .get(proxyURL + "http://api.deezer.com/album/" + album.id + "/tracks")
              .then((response) => {
                console.log(response.data.data);
                response.data.data.forEach((track) => {
                  songs.push(new Song(track.title, track.preview, album.cover_medium));
                });
                console.log("songs", songs.slice());
                resolve();
              })
              .catch((err) => {
                console.log("Track Retrieval Failed", err);
              });
          });
        });
    }).catch((err) => {
      console.log("Album Retrieval Failed", err);
    });
  };
}

function loadQuestion() {
  console.log("songs loadquestion", songs.slice());

  console.log("song lengths", songs.length);

  let arr_songs = [];
  let arr_buttons = [];
  while (arr_songs.length < 4) {
    var r = Math.floor(Math.random() * songs.length);
    if (arr_songs.indexOf(r) === -1) arr_songs.push(r);
  }
  while (arr_buttons.length < 4) {
    var r = Math.floor(Math.random() * 4) + 1;
    if (arr_buttons.indexOf(r) === -1) arr_buttons.push(r);
  }
  console.log(arr_songs);
  console.log(arr_buttons);
  document.getElementById("b" + arr_buttons[0].toString()).innerHTML = songs[arr_songs[0]].name;
  document.getElementById("b" + arr_buttons[1].toString()).innerHTML = songs[arr_songs[1]].name;
  document.getElementById("b" + arr_buttons[2].toString()).innerHTML = songs[arr_songs[2]].name;
  document.getElementById("b" + arr_buttons[3].toString()).innerHTML = songs[arr_songs[3]].name;
  document.getElementById("album_cover").src = songs[arr_songs[0]].album_cover;
  answer = arr_buttons[0];
  console.log("answer", answer);
  if (sound) {
    console.log("caught");
    sound.pause();
    sound.currentTime = 0;
    sound = new Audio(songs[arr_songs[0]].url);
    sound.play();
  } else {
    console.log("else caught");
    sound = new Audio(songs[arr_songs[0]].url);
    sound.play();
  }
}
