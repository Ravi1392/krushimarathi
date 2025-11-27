<!-- Filters -->
    <div class="card">
        <div class="card-header bg-transparent header-elements-inline">
            <span class="text-uppercase font-size-sm font-weight-semibold">Filter products</span>
            <div class="header-elements">
                <div class="list-icons">
                    <a class="list-icons-item" data-action="collapse"></a>
                </div>
            </div>
        </div>

        <div class="card-body">
            <form id="productFilterForm" method="GET">
                <div class="form-group">
                    <div class="font-size-xs text-uppercase text-muted mb-3">Price Range</div>

                    <div class="form-check">
                        <label class="form-check-label">
                            {{-- <div class="uniform-checker"> --}}
                                <span>
                                    <input type="checkbox" class="form-input-styled" name="price[]" value="below_499" {{ in_array('below_499', explode(',', request('price', ''))) ? 'checked' : '' }}>
                                </span>
                            {{-- </div> --}}
                            Below ₹499 
                        </label>	
                    </div>

                    <div class="form-check">
                        <label class="form-check-label">
                            {{-- <div class="uniform-checker"> --}}
                                <span>
                                    <input type="checkbox" class="form-input-styled" name="price[]" value="500_1499" {{ in_array('500_1499', explode(',', request('price', ''))) ? 'checked' : '' }}>
                                </span>
                            {{-- </div> --}}
                            ₹500 – ₹1499
                        </label>
                    </div>

                    <div class="form-check">
                        <label class="form-check-label">
                            {{-- <div class="uniform-checker"> --}}
                                <span>
                                    <input type="checkbox" class="form-input-styled" name="price[]" value="1500_2499" {{ in_array('1500_2499', explode(',', request('price', ''))) ? 'checked' : '' }}>
                                </span>
                            {{-- </div> --}}
                            ₹1500 – ₹2499
                        </label>
                    </div>

                    <div class="form-check">
                        <label class="form-check-label">
                            {{-- <div class="uniform-checker"> --}}
                                <span>
                                    <input type="checkbox" class="form-input-styled" name="price[]" value="2500_4999" {{ in_array('2500_4999', explode(',', request('price', ''))) ? 'checked' : '' }}>
                                </span>
                            {{-- </div> --}}
                            ₹2500 – ₹4999
                        </label>
                    </div>

                    <div class="form-check">
                        <label class="form-check-label">
                            {{-- <div class="uniform-checker"> --}}
                                <span>
                                    <input type="checkbox" class="form-input-styled" name="price[]" value="above_5000" {{ in_array('above_5000', explode(',', request('price', ''))) ? 'checked' : '' }}>
                                </span>
                            {{-- </div> --}}
                            Above ₹5000
                        </label>
                    </div>
                </div>

                <div class="form-group">
                    <div class="font-size-xs text-uppercase text-muted mb-3">Date Range</div>

                    <div class="form-check">
                        <label class="form-check-label">
                            {{-- <div class="uniform-checker"> --}}
                                <span>
                                    <input type="checkbox" class="form-input-styled" name="date_range[]" value="7" {{ in_array('7', explode(',', request('price', ''))) ? 'checked' : '' }}>
                                </span>
                            {{-- </div> --}}
                            Last 7 days
                        </label>	
                    </div>

                    <div class="form-check">
                        <label class="form-check-label">
                            {{-- <div class="uniform-checker"> --}}
                                <span>
                                    <input type="checkbox" class="form-input-styled" name="date_range[]" value="14" {{ in_array('14', explode(',', request('price', ''))) ? 'checked' : '' }}>
                                </span>
                            {{-- </div> --}}
                            Last 14 days
                        </label>
                    </div>

                    <div class="form-check">
                        <label class="form-check-label">
                            {{-- <div class="uniform-checker"> --}}
                                <span>
                                    <input type="checkbox" class="form-input-styled" name="date_range[]" value="30" {{ in_array('30', explode(',', request('price', ''))) ? 'checked' : '' }}>
                                </span>
                            {{-- </div> --}}
                            Last 30 days
                        </label>
                    </div>
                </div>

                <button type="submit" class="btn bg-blue btn-block">Filter</button>
            </form>
        </div>
    </div>
<!-- /filters -->