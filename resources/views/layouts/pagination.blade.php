<div id="list">
    <div v-for="item in paginatedData">
        <a :href="setLink(item)">
            <div class="p-4 border-b hover:bg-gray-50">
                @{{ item.title }}
            </div>
        </a>
    </div>

    <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
            <div>
                <p class="text-sm text-gray-700">
                    Showing <span class="font-medium">@{{ paginatedData[0].id }}</span>
                    to <span class="font-medium">@{{ paginatedData[paginatedData.length - 1] . id }}</span>
                    of <span class="font-medium">@{{ items.length }}</span> results
                </p>
            </div>
            <div>
                <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                    <button onclick="app.prevPage()"
                        class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                        Previous
                    </button>
                    <!-- Current: "z-10 bg-indigo-50 border-indigo-500 text-indigo-600", Default: "bg-white border-gray-300 text-gray-500 hover:bg-gray-50" -->
                    <select v-model="page"
                        class="z-10 bg-indigo-50 border-indigo-500 text-indigo-600 relative inline-flex items-center px-8 py-2 border text-sm font-medium">
                        <option :value=i-1 v-for="i in pageCount">@{{ i }}</option>
                    </select>
                    <button onclick="app.nextPage()"
                        class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                        Next
                    </button>
                </nav>
            </div>
        </div>
    </div>
</div>

<script>
    var app = new Vue({
        el: "#list",
        data: {
            page: 0,
            items: <?php echo json_encode($items); ?>,
            size: 10,
        },
        methods: {
            nextPage() {
                if (this.page < this.pageCount) {
                    this.page++;
                };
            },
            prevPage() {
                if (this.page > 0) {
                    this.page--;
                };
            },
            setLink(item) {
                let url = "{{ route('posts.show', ':id') }}";
                url = url.replace(':id', item.id);
                return url;
            },
        },
        computed: {
            pageCount() {
                let l = this.items.length,
                    s = this.size;
                return Math.ceil(l / s);
            },
            paginatedData() {
                const start = this.page * this.size,
                    end = start + this.size;
                return this.items.slice(start, end);
            },
        },
    });
</script>
