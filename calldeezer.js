
fetchSongs();
let sound = null;
function Question(song_names, prev_urls, img) {
    this.song_names = song_names;
    this.prev_urls = prev_urls;
    this.img = img;
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
      .get("https://cors-anywhere.herokuapp.com/http://api.deezer.com/search/artist?q=" + artistChosen)
      .then((response) => {
        artist_id = response.data.data[0].id;
        getAlbums(artist_id);
      })
      .catch((err) => {
        console.log("Artist ID retrieval failed", err);
      });
  };
    getArtist();

  const getAlbums = async (artist_id) => {
    let album_ids = [];
    let album_count = 0;
    let album_urls = [];
    axios
      .get("https://cors-anywhere.herokuapp.com/http://api.deezer.com/artist/" + artist_id + "/albums")
      .then((response) => {
        response.data.data.forEach((album) => {
          album_ids.push(album.id);
          album_count += 1;
          album_urls.push(album.cover_medium);
        });
        getTracks(album_ids, album_count, album_urls);
      })
      .catch((err) => {
        console.log("Album Retrieval Failed", err);
      });
  };

  const getTracks = async (album_ids, album_count, album_urls) => {
    const random = Math.floor(Math.random() * album_count);
    let track_names = [];
    let prev_urls = [];


    axios
      .get("https://cors-anywhere.herokuapp.com/http://api.deezer.com/album/" + album_ids[random] + "/tracks")
      .then((response) => {
        console.log(response.data);
        response.data.data.forEach((track) => {
          track_names.push(track.title);
          prev_urls.push(track.preview);
        });
        console.log("NAMES: ", track_names);
        console.log("PREV: ", prev_urls);

        let question = new Question(track_names, prev_urls, album_urls[random])
        console.log(question);
  console.log(prev_urls[0])
  document.getElementById("b1").innerHTML = question.song_names[0];
  document.getElementById("b2").innerHTML = question.song_names[1];
  document.getElementById("b3").innerHTML = question.song_names[2];
  document.getElementById("b4").innerHTML = question.song_names[3];
  document.getElementById("album_cover").src = question.img;

  if(sound) {
    console.log("caught");
    sound.pause();
    sound.currentTime = 0;
    sound = new Audio(prev_urls[0]);
    sound.play();
  }
  else{
  console.log("else caught");
  sound = new Audio(prev_urls[0]);
  sound.play();
  }

        }).catch((err) => {
        console.log("Audio retrieval failed", err);
      });






  };
  }







