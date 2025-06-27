
<!-- SEARCH SECTION -->

<section class="teal darken-2 white-text center">
    <div class="container">
        <div class="row m-b-0">
            <div class="col s12">

                <form action="{{ route('search')}} " method="GET">

                    <div class="searchbar">
                        <div class="input-field col s12 m3">
                            <input value="{{ $citySearch ?? '' }}" type="text" name="city" id="autocomplete-input" class="autocomplete custominputbox" autocomplete="off">
                            <label for="autocomplete-input">Tên thành phố hoặc khu vực</label>
                        </div>

                        <div class="input-field col s12 m2">
                            <select name="type" class="browser-default">
                                <option value="" disabled {{ isset($typeSearch) ? '' : 'selected'}}>Chọn loại tài sản</option>
                                <option value="house" {{ isset($typeSearch) ? ($typeSearch == 'house' ? 'selected' : '') : '' }}>Nhà</option>
                                <option value="apartment" {{ isset($typeSearch) ? ($typeSearch == 'apartment' ? 'selected' : '') : '' }}>Căn hộ</option>
                            </select>
                        </div>

                        <div class="input-field col s12 m2">
                            <select name="purpose" class="browser-default">
                                <option value="" disabled {{ isset($purposeSearch) ? '' : 'selected'}}>Chọn kiểu tài sản</option>
                                <option value="sale" {{ isset($purposeSearch) ? ($purposeSearch == 'sale' ? 'selected' : '') : '' }}>Bán</option>
                                <option value="rent" {{ isset($purposeSearch) ? ($purposeSearch == 'rent' ? 'selected' : '') : '' }}>Cho thuê</option>
                            </select>
                        </div>

                        <div class="input-field col s12 m2">
                            <select name="bedroom" class="browser-default">
                                <option value="" disabled {{ isset($bathroomNumber) ? '' : 'selected'}}>Số phòng ngủ</option>
                                @if(isset($bedroomdistinct))
                                    @foreach($bedroomdistinct as $bedroomcurrent)
                                        <option value="{{$bedroomcurrent->bedroom}}" {{ isset($bathroomNumber) ? ($bedroomcurrent->bedroom == $bathroomNumber ? 'selected' : '') : '' }}>{{$bedroomcurrent->bedroom}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>

                        <div class="input-field col s12 m2">
                            <input value="{{ $maxprice ?? '' }}" type="text" name="maxprice" id="maxprice" class="custominputbox">
                            <label for="maxprice">Giá</label>
                        </div>
                        
                        <div class="input-field col s12 m1">
                            <button class="btn btnsearch waves-effect waves-light w100" type="submit">
                                <i class="material-icons">search</i>
                            </button>
                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>
</section>