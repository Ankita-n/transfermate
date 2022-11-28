<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Transfermate</title>
    <style>
        * {
            box-sizing: border-box
        }
        body {
            font-family: Verdana, sans-serif;
            margin: 0
        }
        .mySlides {
            display: none;
            text-align: center;
        }
        .main-div {
            vertical-align: middle;
            text-align: center;
        }
        .slideshow-container {
            max-width: 1000px;
            position: relative;
            margin: auto;
        }
        .prev,
        .next {
            cursor: pointer;
            position: absolute;
            top: 50%;
            width: auto;
            padding: 16px;
            margin-top: -22px;
            color: black;
            font-weight: bold;
            font-size: 18px;
            transition: 0.6s ease;
            border-radius: 0 3px 3px 0;
            user-select: none;
        }
        .next {
            right: 0;
            border-radius: 3px 0 0 3px;
        }
        .prev:hover,
        .next:hover {
            background-color: rgba(0, 0, 0, 0.8);
        }
        .text {
            color: #000000;
            font-size: 15px;
            padding: 8px 12px;
            position: absolute;
            bottom: 8px;
            width: 100%;
            text-align: center;
        }
        .numbertext {
            color: #ffffff;
            font-size: 12px;
            padding: 8px 12px;
            position: absolute;
            top: 0;
        }
        .dot {
            cursor: pointer;
            height: 15px;
            width: 15px;
            margin: 0 2px;
            background-color: #999999;
            border-radius: 50%;
            display: inline-block;
            transition: background-color 0.6s ease;
        }
        .active,
        .dot:hover {
            background-color: #111111;
        }
        .fade {
            -webkit-animation-name: fade;
            -webkit-animation-duration: 1.5s;
            animation-name: fade;
            animation-duration: 1.5s;
        }
        @-webkit-keyframes fade {
            from {
                opacity: .4
            }

            to {
                opacity: 1
            }
        }
        @keyframes fade {
            from {
                opacity: .4
            }

            to {
                opacity: 1
            }
        }
        @media only screen and (max-width: 300px) {
            .prev,
            .next,
            .text {
                font-size: 11px
            }
        }
        .heading h2 {
            width: 100%;
            float: left;
            text-align: center;
        }
        table,
        th,
        td {
            border: 1px solid black;
        }
        .search-div{
            color: #000000;
            font-size: 15px;
            padding: 8px 12px;
            bottom: 8px;
            width: 100%;
            text-align: center;
        }
        .fetch-btn-div{
            text-align: right;
            padding: 8px 12px;
        }
        .button{
            background-color: #4CAF50;
            border: none;
            color: white;
            padding: 5px 15px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
        }
    </style>
</head>

<body>
    <header>
        <div class="fetch-btn-div">
            <a href="{{ route('store.data') }}"><button class="button" type="submit">Fetch & Store Data</button></a>
        </div>
        <div class="heading">
            <h2>Author Info</h2>
        </div>

    </header>
    <article>
        <section>
            <div class="search-div">
            <form action="{{ route('search.data') }}" method="POST">
                @csrf
                <input type="text" placeholder="Search By Author Name" name="search_data"
                    value="@if (isset($search_data)) {{ $search_data }} @endif" style="padding: 5px 15px;">
                <button type="submit" class="button">Search</button>
            </form>
            </div>
            @if (isset($author_infos) && count($author_infos) > 0)
                <div class="slideshow-container">
                    @foreach ($author_infos as $author_info)
                        <table class="border" style="width:100%">
                            <tr>
                                <th>Author</th>
                                <th>Book Title</th>
                            </tr>
                            @if (!empty($author_info->books))
                                @foreach ($author_info->books as $book)
                                    <tr class="mySlides fade">
                                        <td>{{ $author_info->author_name }}</td>
                                        <td>{{ $book->title }}</td>
                                    </tr>
                                @endforeach
                            @endif

                        </table>
                    @endforeach
                    <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                    <a class="next" onclick="plusSlides(1)">&#10095;</a>
                </div>
                <br>
                <div style="text-align:center;display: none">
                    @if (!empty($author_info->books))
                        @foreach ($author_info->books as $key => $book)
                            <span class="dot" onclick="currentSlide($key)"></span>
                        @endforeach
                    @endif
                </div>

            @endif
        </section>
    </article>
    <script>
        let slideIndex = 0;
        let totalSlides = document.getElementsByClassName("dot").length - 1;
        let timeoutId = null;
        const slides = document.getElementsByClassName("mySlides");
        const dots = document.getElementsByClassName("dot");

        showSlides();

        function currentSlide(index) {
            slideIndex = index;
            showSlides();
        }

        function plusSlides(step) {
            if (step < 0) {
                slideIndex -= totalSlides;

                if (slideIndex < 0) {
                    slideIndex = slides.length - 1;
                }
            }
            showSlides();
        }

        function showSlides() {
            for (let i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
                dots[i].classList.remove('active');
            }
            slideIndex++;
            if (slideIndex > slides.length) {
                slideIndex = 1
            }
            slides[slideIndex - 1].style.display = "block";
            slides[slideIndex - 1].style.display = "table-row";
            dots[slideIndex - 1].classList.add('active');
            if (timeoutId) {
                clearTimeout(timeoutId);
            }
            timeoutId = setTimeout(showSlides, 1000); // Change tr every 1 seconds
        }
    </script>
</body>

</html>
