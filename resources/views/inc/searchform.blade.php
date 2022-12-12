<form action="{{route('propertySearch')}}" id="selectSearch" method="GET">
    <input name="township" autocomplete="off" type="text" id="searchTown" placeholder="Township Name">
    <div class="ygTowns">
        <li class="town">Ahlone</li>
        <li class="town">Bahan</li>
        <li class="town">Botataung</li>
        <li class="town">Dagon</li>
        <li class="town">Dagon Myothit (east)</li>
        <li class="town">Dagon Myothit (North)</li>
        <li class="town">Dagon Myothit (South)</li>
        <li class="town">Dawbon</li>
        <li class="town">Hlaing</li>
        <li class="town">Hlaingthaya</li>
        <li class="town">Insein</li>
        <li class="town">Kamaryut</li>
        <li class="town">Kyauktada</li>
        <li class="town">Kyeemyindaing</li>
        <li class="town">Lanmadaw</li>
        <li class="town">Latha</li>
        <li class="town">Mayangone</li>
        <li class="town">Mingaladon</li>
        <li class="town">Mingalartaungnyunt</li>
        <li class="town">North Okkalapa</li>
        <li class="town">Pabedan</li>
        <li class="town">Pazundaung</li>
        <li class="town">Sangchaung</li>
        <li class="town">Sekkan</li>
        <li class="town">Shwepyithar</li>
        <li class="town">South Okkalapa</li>
        <li class="town">Tamwe</li>
        <li class="town">Thaketa</li>
        <li class="town">Thingangyun</li>
        <li class="town">Yankin</li>
        <li class="town">Other Township</li>
    </div>
    <input name="saleRent" type="text" id="searchSaleRent" value="For Sale" readonly>
    <div class="saleRent">
        <li class="sr">For Sale</li>
        <li class="sr">For Rent</li>
    </div>
    <input name="category" type="text" id="searchType" placeholder="Select One" readonly>
    <div class="proType">
        <li class="pt">Private House</li>
        <li class="pt">Condo</li>
        <li class="pt">Apartment</li>
        <li class="pt">Shop and Store</li>
        <li class="pt">Land</li>
        <li class="pt">Industrial Zone and Warehouse</li>
    </div>
    <button type="submit">Search</button>
</form>