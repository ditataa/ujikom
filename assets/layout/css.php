<link rel="stylesheet" href="<?= $base_url ?>assets/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
 
<style>
    body {
    min-height: 500px;
    background: url('http://dita.test/assets/bg.png');
    }

    /* Container to wrap the image and the buttons */
    .image-hover-container {
        position: relative;
        display: inline-block;
        width: 100%;
        height: 300px;
        overflow: hidden; /* Hide the overflow for cropping effect */
    }

    /* Image styling */
    .card-img-top {
        position: relative;
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: opacity 0.3s ease-in-out;
        border-top-left-radius: 0; /* Ensure image has no border-radius on top */
        border-top-right-radius: 0;
    }

    /* Fade in buttons on hover */
    .hover-buttons {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        opacity: 0;
        transition: opacity 0.3s ease-in-out;
        display: flex;
        gap: 10px;
    }

    /* Hover to show buttons and darken image */
    .image-hover-container:hover .card-img-top {
        opacity: 0.7;
    }

    .image-hover-container:hover .hover-buttons {
        opacity: 1;
    }

    /* Like and comment buttons styling */
    .interaction-buttons {
        display: flex;
        justify-content: space-between;
        padding: 10px;
        background-color: #f8f9fa;
        border-top: 1px solid #e1e1e1;
        border-bottom-left-radius: 5px;
        border-bottom-right-radius: 5px;
    }

    .like-btn, .comment-btn {
        display: flex;
        align-items: center;
        gap: 5px;
        padding: 5px 10px;
        background-color: #007bff;
        color: #fff;
        border-radius: 30px;
        cursor: pointer;
        transition: background-color 0.3s ease-in-out;
    }

    .like-btn:hover, .comment-btn:hover {
        background-color: #0056b3;
    }

    .interaction-counter {
        font-size: 14px;
    }

    .icon {
        font-size: 18px;
    }

    /* Caption styling */
    .image-caption {
        padding: 10px;
        font-size: 14px;
        color: #555;
        background-color: #f1f1f1;
        border-bottom: 1px solid #e1e1e1;
        border-top-left-radius: 5px;
        border-top-right-radius: 5px;
        margin: 0; /* Remove margin */
        border-radius: 0; /* Ensure no extra border radius */
    }

    
    .main-image-container {
        max-width: 60%; /* Reduced max width for smaller display */
        overflow: hidden;
        border-radius: 15px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        margin: 0 auto;
        cursor: pointer; /* Indicate it's clickable */
    }

    .main-image {
        width: 100%;
        height: auto;
        display: block;
        transition: transform 0.3s ease;
    }

    .main-image-container:hover .main-image {
        transform: scale(1.05);
    }

    /* Lightbox Styling */
    .lightbox {
        display: none; /* Hidden by default */
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.8); /* Dark overlay */
        justify-content: center;
        align-items: center;
        z-index: 1000;
    }

    .lightbox img {
        max-width: 90%;
        max-height: 90%;
        border-radius: 8px;
    }

    .comment-section {
        background-color: white;
    }

    .comment-avatar img {
        border: 2px solid #6fc1ff; /* Optional: Add a border to match your theme color */
    }

    .comment-content h6 {
        font-size: 1rem;
        margin: 0;
        font-weight: bold;
    }

    .comment-content p {
        margin: 0;
        color: #555;
    }

    .comment-content small {
        font-size: 0.85rem;
        color: #888;
    }
</style>