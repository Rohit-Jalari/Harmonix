<div class="news-feed news-feed-form">
    <div class="row">
        <div class="col-5">
            <h3 class="news-feed-title">Create New Post</h3>
        </div>
        <div class="col-7 news-feed-title">
            <ul class="button-group d-flex justify-content-between align-items-center">
                <li class="tag-btn" style="list-style:none;">
                    <button class="btn btn-warning" style="color:#2a2323;font-size:1.1rem;font-weight:bold;" onclick="window.location.href = '../studio/pages/studioSeparate.php';"><i class="flaticon-tag"></i> Studio</button>
                </li>
            </ul>
        </div>
    </div>

    <form>
        <div class="form-group">
            <textarea name="message" class="form-control" placeholder="Write something here..."></textarea>
        </div>
        <ul class="button-group d-flex justify-content-between align-items-center">
            <li class="photo-btn">
                <button><i class="flaticon-gallery"></i> Photo</button>
            </li>
            <li class="video-btn">
                <button type="submit"><i class="flaticon-video"></i> Video</button>
            </li>
            <li class="post-btn">
                <button type="submit">Post</button>
            </li>
        </ul>
    </form>
</div>