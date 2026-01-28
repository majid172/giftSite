@extends('admin.layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <h5 class="text-base-content text-lg font-medium">Site Settings <span class="text-xs text-base-content/50">(General Settings)</span></h5>
        </div>
        <div class="card-body gap-8">
            <form class="space-y-6" onsubmit="return false;">
                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                    <div>
                        <label class="label-text" for="name">Site Name</label>
                        <input type="text" id="name" name="name" class="input" placeholder="John">
                    </div>
                    <div>
                        <label class="label-text" for="description">Site Description</label>
                        <input type="text" id="description" name="description" class="input" placeholder="Doe">
                    </div>
                    <div>
                        <label class="label-text" for=" email">E-mail</label>
                        <input type="email" id="email" name="email" class="input"
                            placeholder="john.doe@example.com">
                    </div>
                    <div>
                        <label class="label-text" for="organization">Organization</label>
                        <input type="text" id="organization" name="organization" class="input" placeholder="Themeselection">
                    </div>
                    <div>
                        <label class="label-text" for="number">Phone Number</label>
                        <input type="text" id="number" name="number" class="input" placeholder="202 555 0111">
                    </div>
                    <div>
                        <label class="label-text" for="address">Address</label>
                        <input type="text" id="address" name="address" class="input" placeholder="Address">
                    </div>
                    <div>
                        <label class="label-text" for="state">State</label>
                        <input type="text" id="state" name="state" class="input" placeholder="California">
                    </div>
                    <div>
                        <label class="label-text" for="zipCode">Zip Code</label>
                        <input type="text" id="zipCode" name="zipCode" class="input" placeholder="231465"
                            maxlength="6">
                    </div>
                    <div>
                        <label class="label-text" for="coutry">Country</label>
                        <div class="max-w-full">
                            <div class="advance-select relative"><select
                                    data-select="{
    &quot;placeholder&quot;: &quot;Select&quot;,
    &quot;toggleTag&quot;: &quot;&lt;button type=\&quot;button\&quot; aria-expanded=\&quot;false\&quot;&gt;&lt;/button&gt;&quot;,
    &quot;toggleClasses&quot;: &quot;advance-select-toggle select-disabled:pointer-events-none select-disabled:opacity-40&quot;,
    &quot;hasSearch&quot;: true,
    &quot;dropdownClasses&quot;: &quot;advance-select-menu max-h-52 pt-0 overflow-y-auto&quot;,
    &quot;optionClasses&quot;: &quot;advance-select-option selected:select-active&quot;,
    &quot;optionTemplate&quot;: &quot;&lt;div class=\&quot;flex justify-between items-center w-full\&quot;&gt;&lt;span data-title&gt;&lt;/span&gt;&lt;span class=\&quot;icon-[tabler--check] shrink-0 size-4 text-primary hidden selected:block \&quot;&gt;&lt;/span&gt;&lt;/div&gt;&quot;,
    &quot;extraMarkup&quot;: &quot;&lt;span class=\&quot;icon-[tabler--chevron-down] shrink-0 size-4 text-base-content absolute top-1/2 end-3 -translate-y-1/2 \&quot;&gt;&lt;/span&gt;&quot;
    }"
                                    class="hidden" style="display: none;">

























                                    <option value="">Select</option>
                                    <option value="Australia">Australia</option>
                                    <option value="Bangladesh">Bangladesh</option>
                                    <option value="Belarus">Belarus</option>
                                    <option value="Brazil">Brazil</option>
                                    <option value="Canada">Canada</option>
                                    <option value="China">China</option>
                                    <option value="France">France</option>
                                    <option value="Germany">Germany</option>
                                    <option value="India">India</option>
                                    <option value="Indonesia">Indonesia</option>
                                    <option value="Israel">Israel</option>
                                    <option value="Italy">Italy</option>
                                    <option value="Japan">Japan</option>
                                    <option value="Korea">Korea, Republic of</option>
                                    <option value="Mexico">Mexico</option>
                                    <option value="Philippines">Philippines</option>
                                    <option value="Russia">Russian Federation</option>
                                    <option value="South Africa">South Africa</option>
                                    <option value="Thailand">Thailand</option>
                                    <option value="Turkey">Turkey</option>
                                    <option value="Ukraine">Ukraine</option>
                                    <option value="United Arab Emirates">United Arab Emirates</option>
                                    <option value="United Kingdom">United Kingdom</option>
                                    <option value="United States">United States</option>
                                </select><button type="button" aria-expanded="false"
                                    class="advance-select-toggle select-disabled:pointer-events-none select-disabled:opacity-40"><span
                                        class="truncate">Select</span></button>
                                <div data-select-dropdown=""
                                    class="absolute top-full hidden advance-select-menu max-h-52 pt-0 overflow-y-auto"
                                    role="listbox" tabindex="-1" aria-orientation="vertical">
                                    <div class="bg-base-100 sticky top-0 mb-2 px-2 pt-3"><input type="text"
                                            placeholder="Search..."
                                            class="border-base-content/40 focus:border-primary focus:outline-primary bg-base-100 block w-full rounded-field border px-3 py-2 text-base focus:outline-1">
                                    </div>
                                    <div data-value="Australia" data-title-value="Australia" tabindex="0"
                                        class="cursor-pointer advance-select-option selected:select-active"
                                        data-id="0">
                                                Kingdom</span><span
                                                class="icon-[tabler--check] shrink-0 size-4 text-primary hidden selected:block "></span>
                                        </div>
                                    </div>
                                    <div data-value="United States" data-title-value="United States" tabindex="23"
                                        class="cursor-pointer advance-select-option selected:select-active"
                                        data-id="23">
                                        <div class="flex justify-between items-center w-full"><span data-title="">United
                                                States</span><span
                                                class="icon-[tabler--check] shrink-0 size-4 text-primary hidden selected:block "></span>
                                        </div>
                                    </div>
                                </div><span
                                    class="icon-[tabler--chevron-down] shrink-0 size-4 text-base-content absolute top-1/2 end-3 -translate-y-1/2 "></span>
                            </div>
                        </div>
                    </div>
                    <div>
                        <label class="label-text" for="language">Language</label>
                        <div class="max-w-full">
                            <div class="advance-select relative"><select
                                    data-select="{
    &quot;placeholder&quot;: &quot;Select Language&quot;,
    &quot;toggleTag&quot;: &quot;&lt;button type=\&quot;button\&quot; aria-expanded=\&quot;false\&quot;&gt;&lt;/button&gt;&quot;,
    &quot;toggleClasses&quot;: &quot;advance-select-toggle select-disabled:pointer-events-none select-disabled:opacity-40&quot;,
    &quot;hasSearch&quot;: true,
    &quot;dropdownClasses&quot;: &quot;advance-select-menu max-h-52 pt-0 overflow-y-auto&quot;,
    &quot;optionClasses&quot;: &quot;advance-select-option selected:select-active&quot;,
    &quot;optionTemplate&quot;: &quot;&lt;div class=\&quot;flex justify-between items-center w-full\&quot;&gt;&lt;span data-title&gt;&lt;/span&gt;&lt;span class=\&quot;icon-[tabler--check] shrink-0 size-4 text-primary hidden selected:block \&quot;&gt;&lt;/span&gt;&lt;/div&gt;&quot;,
    &quot;extraMarkup&quot;: &quot;&lt;span class=\&quot;icon-[tabler--chevron-down] shrink-0 size-4 text-base-content absolute top-1/2 end-3 -translate-y-1/2 \&quot;&gt;&lt;/span&gt;&quot;
    }"
                                    class="hidden" style="display: none;">





                                    <option value="">Select Language</option>
                                    <option value="en">English</option>
                                    <option value="fr">French</option>
                                    <option value="de">German</option>
                                    <option value="pt">Portuguese</option>
                                </select><button type="button" aria-expanded="false"
                                    class="advance-select-toggle select-disabled:pointer-events-none select-disabled:opacity-40"><span
                                        class="truncate">Select Language</span></button>
                                <div data-select-dropdown=""
                                    class="absolute top-full hidden advance-select-menu max-h-52 pt-0 overflow-y-auto"
                                    role="listbox" tabindex="-1" aria-orientation="vertical">
                                    <div class="bg-base-100 sticky top-0 mb-2 px-2 pt-3"><input type="text"
                                            placeholder="Search..."
                                            class="border-base-content/40 focus:border-primary focus:outline-primary bg-base-100 block w-full rounded-field border px-3 py-2 text-base focus:outline-1">
                                    </div>
                                    <div data-value="en" data-title-value="English" tabindex="0"
                                        class="cursor-pointer advance-select-option selected:select-active"
                                        data-id="0">
                                        <div class="flex justify-between items-center w-full"><span
                                                data-title="">English</span><span
                                                class="icon-[tabler--check] shrink-0 size-4 text-primary hidden selected:block "></span>
                                        </div>
                                    </div>
                                    <div data-value="fr" data-title-value="French" tabindex="1"
                                        class="cursor-pointer advance-select-option selected:select-active"
                                        data-id="1">
                                        <div class="flex justify-between items-center w-full"><span
                                                data-title="">French</span><span
                                                class="icon-[tabler--check] shrink-0 size-4 text-primary hidden selected:block "></span>
                                        </div>
                                    </div>
                                    <div data-value="de" data-title-value="German" tabindex="2"
                                        class="cursor-pointer advance-select-option selected:select-active"
                                        data-id="2">
                                        <div class="flex justify-between items-center w-full"><span
                                                data-title="">German</span><span
                                                class="icon-[tabler--check] shrink-0 size-4 text-primary hidden selected:block "></span>
                                        </div>
                                    </div>
                                    <div data-value="pt" data-title-value="Portuguese" tabindex="3"
                                        class="cursor-pointer advance-select-option selected:select-active"
                                        data-id="3">
                                        <div class="flex justify-between items-center w-full"><span
                                                data-title="">Portuguese</span><span
                                                class="icon-[tabler--check] shrink-0 size-4 text-primary hidden selected:block "></span>
                                        </div>
                                    </div>
                                </div><span
                                    class="icon-[tabler--chevron-down] shrink-0 size-4 text-base-content absolute top-1/2 end-3 -translate-y-1/2 "></span>
                            </div>
                        </div>
                    </div>
                    
                    <div>
                        <label class="label-text" for="currency">Currency</label>
                        <div class="max-w-full">
                            <div class="advance-select relative"><select
                                    data-select="{
    &quot;placeholder&quot;: &quot;Select Timezone&quot;,
    &quot;toggleTag&quot;: &quot;&lt;button type=\&quot;button\&quot; aria-expanded=\&quot;false\&quot;&gt;&lt;/button&gt;&quot;,
    &quot;toggleClasses&quot;: &quot;advance-select-toggle select-disabled:pointer-events-none select-disabled:opacity-40&quot;,
    &quot;hasSearch&quot;: true,
    &quot;dropdownClasses&quot;: &quot;advance-select-menu max-h-52 pt-0 overflow-y-auto&quot;,
    &quot;optionClasses&quot;: &quot;advance-select-option selected:select-active&quot;,
    &quot;optionTemplate&quot;: &quot;&lt;div class=\&quot;flex justify-between items-center w-full\&quot;&gt;&lt;span data-title&gt;&lt;/span&gt;&lt;span class=\&quot;icon-[tabler--check] shrink-0 size-4 text-primary hidden selected:block \&quot;&gt;&lt;/span&gt;&lt;/div&gt;&quot;,
    &quot;extraMarkup&quot;: &quot;&lt;span class=\&quot;icon-[tabler--chevron-down] shrink-0 size-4 text-base-content absolute top-1/2 end-3 -translate-y-1/2 \&quot;&gt;&lt;/span&gt;&quot;
    }"
                                    class="hidden" style="display: none;">





                                    <option value="">Select Currency</option>
                                    <option value="usd">USD</option>
                                    <option value="euro">Euro</option>
                                    <option value="pound">Pound</option>
                                    <option value="bitcoin">Bitcoin</option>
                                </select><button type="button" aria-expanded="false"
                                    class="advance-select-toggle select-disabled:pointer-events-none select-disabled:opacity-40"><span
                                        class="truncate">Select Timezone</span></button>
                                <div data-select-dropdown=""
                                    class="absolute top-full hidden advance-select-menu max-h-52 pt-0 overflow-y-auto"
                                    role="listbox" tabindex="-1" aria-orientation="vertical">
                                    <div class="bg-base-100 sticky top-0 mb-2 px-2 pt-3"><input type="text"
                                            placeholder="Search..."
                                            class="border-base-content/40 focus:border-primary focus:outline-primary bg-base-100 block w-full rounded-field border px-3 py-2 text-base focus:outline-1">
                                    </div>
                                    <div data-value="usd" data-title-value="USD" tabindex="0"
                                        class="cursor-pointer advance-select-option selected:select-active"
                                        data-id="0">
                                        <div class="flex justify-between items-center w-full"><span
                                                data-title="">USD</span><span
                                                class="icon-[tabler--check] shrink-0 size-4 text-primary hidden selected:block "></span>
                                        </div>
                                    </div>
                                    <div data-value="euro" data-title-value="Euro" tabindex="1"
                                        class="cursor-pointer advance-select-option selected:select-active"
                                        data-id="1">
                                        <div class="flex justify-between items-center w-full"><span
                                                data-title="">Euro</span><span
                                                class="icon-[tabler--check] shrink-0 size-4 text-primary hidden selected:block "></span>
                                        </div>
                                    </div>
                                    <div data-value="pound" data-title-value="Pound" tabindex="2"
                                        class="cursor-pointer advance-select-option selected:select-active"
                                        data-id="2">
                                        <div class="flex justify-between items-center w-full"><span
                                                data-title="">Pound</span><span
                                                class="icon-[tabler--check] shrink-0 size-4 text-primary hidden selected:block "></span>
                                        </div>
                                    </div>
                                    <div data-value="bitcoin" data-title-value="Bitcoin" tabindex="3"
                                        class="cursor-pointer advance-select-option selected:select-active"
                                        data-id="3">
                                        <div class="flex justify-between items-center w-full"><span
                                                data-title="">Bitcoin</span><span
                                                class="icon-[tabler--check] shrink-0 size-4 text-primary hidden selected:block "></span>
                                        </div>
                                    </div>
                                </div><span
                                    class="icon-[tabler--chevron-down] shrink-0 size-4 text-base-content absolute top-1/2 end-3 -translate-y-1/2 "></span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Submit Button -->
                <div class="flex gap-3">
                    <button class="btn btn-primary">Save Changes</button>
                    <button class="btn btn-soft btn-secondary">Cancel</button>
                </div>
            </form>
        </div>
    </div>
    </div>
@endsection
