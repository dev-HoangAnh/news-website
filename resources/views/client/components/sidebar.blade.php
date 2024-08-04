<aside class="col-lg-4 sidebar-home">
    <!-- Search -->
    <div class="widget">
        <h4 class="widget-title"><span>Tìm kiếm</span></h4>
        <form action="{{ route('search') }}" class="widget-search">
            <input class="mb-3" id="query" name="query" type="text" placeholder="Tìm kiếm...">
            <i class="ti-search"></i>
            <button type="submit" class="btn btn-primary btn-block">Tìm kiếm</button>
        </form>
    </div>

    <!-- about me -->
    <div class="widget widget-about">
        <h4 class="widget-title">XIN CHÀO!</h4>
        <img class="img-fluid" src="/client/images/author.jpg" alt="Themefisher">
        <a href="{{ route('login') }}" class="btn btn-primary mb-2">Đăng nhập</a><br>
        <a href="{{ route('register') }}" class="btn btn-warning mb-2">Đăng kí</a>
    </div>

    <!-- categories -->
    <div class="widget widget-categories">
        <h4 class="widget-title"><span>Danh mục tin tức</span></h4>
        <ul class="list-unstyled widget-list">

            @foreach ($categories as $category)
                <li>
                    <a href="{{ route('categories.show.client', $category->id) }}"
                        class="d-flex">{{ $category->name }}</a>
                </li>
            @endforeach

        </ul>
    </div>

</aside>
