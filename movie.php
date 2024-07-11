<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movies</title>
    <style>
        .movie {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
        }
        .movie img {
            max-width: 100px;
            margin-right: 10px;
        }
        .movie h2 {
            margin-top: 0;
        }
        .movie p {
            margin: 5px 0;
        }
    </style>
</head>
<body>
<?php

$curl = curl_init();

curl_setopt_array($curl, [
	CURLOPT_URL => "https://imdb-top-100-movies.p.rapidapi.com/",
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "GET",
	CURLOPT_HTTPHEADER => [
		"x-rapidapi-host: imdb-top-100-movies.p.rapidapi.com",
		"x-rapidapi-key: 3696befd11mshaaaeab49fcaf07bp1bf080jsn71868f139c5c"
	],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
	echo "cURL Error #:" . $err;
} else {
	$data = json_decode($response, true);

	if (!empty($data)) {
		foreach ($data as $movie) {
			$title = $movie['title'];
			$image = $movie['image'];
			$genre = implode(', ', $movie['genre']);
			$rating = $movie['rating']; // Duration is not provided in the API response

			echo "<div class='movie'>";
			echo "<img src='$image' alt='$title'>";
			echo "<div>";
			echo "<h2>$title</h2>";
			echo "<p><strong>Genre:</strong> $genre</p>";
			echo "<p><strong>rating:</strong> $rating</p>";
			echo "</div>";
			echo "</div>";
		}
	} else {
		echo "No movies found.";
	}
}
?>
</body>
</html>
