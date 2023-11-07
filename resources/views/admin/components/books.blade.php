<div id="books">
    <h2 class="header">Books</h2>

    <div class="layout-2">
        <div class="monitor">
            <h4>Right Now</h4>
            <div class="clearfix">
                <ul class="content books">
                    <li>list</li>
                </ul>
            </div>
        </div>
        <div class="quick-press">
            <h4>Quick Add</h4>
            <form method="post" enctype="multipart/form-data">
                <input type="text" id="bookname" placeholder="book name" />
                <input type="text" id="bookprice" placeholder="book price" />
                <input type="text" id="published_date" placeholder="published date" />
                <select id="author">
                    <option value="" disabled selected>chọn tác giả</option>
                </select>
                <input type="file" id="cover" />

                <div style="display: flex;margin: 8px 0;gap:8px;align-items:center">
                    Publish:
                    <input class="tgl tgl-ios" id="publish" type="checkbox" />
                    <label class="tgl-btn" for="publish"></label>
                </div>

                <button type="button" class="save">S</button>
                <button type="button" class="delet">D</button>
                <button type="submit" class="submit" id="addbook">Publish</button>
            </form>
        </div>
    </div>
</div>

@push('scripts')
@endpush
