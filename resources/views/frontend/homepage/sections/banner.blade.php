

<div class="max-w-screen-2xl mx-auto pt-6  px-4 sm:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
    <div class="lg:col-span-5">
        <div class="relative w-full overflow-hidden rounded-xl shadow-2xl transition duration-300 ease-in-out hover:shadow-primary-lg">
            <div class="absolute inset-0 bg-gradient-to-b from-black/60 via-black/40 to-black/70"></div>
            <img src="{{ asset('uploads/' . ($banners->image ?? '')) }}" alt="{{ $banners->title ?? 'Featured Stock Market Banner' }}"
                 class="w-full h-64 sm:h-80 md:h-[32rem] object-cover filter brightness-90">
            
            <div class="absolute bottom-4 left-4 right-4 text-white p-2">
                <span class="inline-block px-3 py-1 mb-2 text-xs font-semibold uppercase tracking-wider bg-red-600 rounded-full shadow-md">Featured</span>
                <h3 class="text-3xl font-extrabold leading-snug line-clamp-3 drop-shadow-lg">
                    {{ $banners->title ?? 'NEPSE Market Overview: Trends & Analysis' }}
                </h3>
            </div>
        </div>
    </div>

    <div class="lg:col-span-7 mt-8">
        <div class="bg-white p-6 rounded-xl shadow-2xl border border-gray-100">
            <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4 mb-4">
                <div>
                    <h2 class="text-3xl font-bold tracking-tight text-gray-800">Live NEPSE Stocks <span class="text-red-500">•</span></h2>
                </div>

                <div class="w-full sm:w-80 relative">
                    <input type="text" id="searchInput"
                           class="w-full pl-10 pr-8 py-2 border-2 border-gray-200 rounded-lg shadow-inner focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition duration-150"
                           placeholder="Search by symbol (e.g., HBL)" 
                           oninput="handleSearchInput()"
                    >
                    <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 103.5 3.5a7.5 7.5 0 0013.15 13.15z" /></svg>
                    </span>
                    <button type="button" aria-label="Clear Search"
                            class="absolute right-2 top-1/2 -translate-y-1/2 text-gray-400 hover:text-red-500 transition duration-150"
                            onclick="document.getElementById('searchInput').value=''; filterData();">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                    </button>
                </div>
            </div>

            <div id="stockCount" class="mb-3 text-sm font-medium text-gray-600">Loading...</div>

            <div id="tableContainer" class="overflow-x-auto overflow-y-auto max-h-[30rem] border border-gray-200 rounded-lg shadow-md scrollbar-thin scrollbar-thumb-rounded scrollbar-thumb-gray-400 scrollbar-track-gray-100">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50 sticky top-0 z-10 shadow-sm">
                        <tr>
                            <th class="px-5 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Symbol</th>
                            <th class="px-5 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider hidden sm:table-cell">Company</th>
                            <th class="px-5 py-3 text-right text-xs font-bold text-gray-600 uppercase tracking-wider">LTP (Rs.)</th>
                            <!-- <th class="px-5 py-3 text-right text-xs font-bold text-gray-600 uppercase tracking-wider">Change</th> -->
                            <th class="px-5 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider hidden md:table-cell">Updated</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody" class="divide-y divide-gray-100">
                        </tbody>
                </table>
            </div>

            <div id="pagination" class="flex items-center justify-center gap-2 mt-4"></div>

            <div id="noDataMessage" class="hidden flex justify-center items-center h-32 mt-4 text-gray-500 text-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                No stocks found matching your search.
            </div>
        </div>
    </div>
</div>

<script>
    // =================================================================
    // JAVASCRIPT LOGIC (Optimized for UI rendering)
    // =================================================================
    
    // Use correct uppercase symbols
    const stockSymbols = [
        'GBIME', 'NIMB', 'ADBL', 'CZBIL', 'EBL', 'GBIME', 'HBL', 'KBL', 
        'MBL', 'NABIL', 'NBL', 'NICA', 'NMB', 'PCBL', 'SANIMA', 'SBI', 'SBL', 'SCB', 
        'PRVU', 'RBB', 'NIMB', 'LSL', 'CORBL', 'EDBL', 'GBBL', 'JBBL', 'KRBL', 'MDB', 
        'MNBBL', 'NABBC', 'SADBL', 'SHINE', 'SINDU', 'GRDBL', 'MLBL', 'LBBL', 'KSBBL', 
        'SAPDBL', 'CFCL', 'GFCL', 'GMFIL', 'ICFC', 'JFL', 'MFIL', 'MPFL', 'NFS', 'PFL', 
        'PROFL', 'SIFC', 'RLFL', 'BFC', 'SFCL', 'OHL', 'SHL', 'TRH', 'CGH', 'KDL', 'CITY', 
        'AHPC', 'BPCL', 'CHCL', 'NHPC', 'SHPC', 'RHPC', 'HURJA', 'AKPL', 'BARUN', 'API', 
        'NGPL', 'MHL', 'NYADI', 'SJCL', 'RHPL', 'UMHL', 'DORDI', 'PHCL', 'PPL', 'UPCL', 
        'SPL', 'SPDL', 'MKJC', 'SAHAS', 'KKHC', 'HPPL', 'DHPL', 'BHPL', 'MHNL', 'CHL', 
        'USHL', 'SPHL', 'NHDL', 'RADHI', 'BNHC', 'RHGCL', 'KPCL', 'TAMOR', 'GHL', 'EHPL', 
        'MKHC', 'BEDC', 'PMHPL', 'KBSH', 'MBJC', 'GLH', 'USHEC', 'AKJCL', 'LEC', 'TPC', 
        'SHEL', 'PPCL', 'TSHL', 'SSHL', 'JOSHI', 'UPPER', 'TVCL', 'UNHPL', 'SPC', 'SGHC', 
        'AHL', 'BHDC', 'HDHPC', 'MHCL', 'SMH', 'RFPL', 'MEN', 'UHEWA', 'HHL', 'UMRH', 
        'SIKLES', 'MEL', 'RURU', 'MAKAR', 'SMJC', 'MKHL', 'CKHL', 'MMKJL', 'DOLTI', 
        'BHL', 'GVL', 'MSHL', 'RIDI', 'MEHL', 'IHL', 'SMHL', 'MCHL', 'RAWA', 'ULHC', 
        'BGWT', 'MANDU', 'VLUCL', 'CIT', 'HATHY', 'HIDCL', 'NIFRA', 'ENL', 'NRN', 'CHDC', 
        'ALICL', 'LICN', 'NLIC', 'NLICL', 'CLI', 'RNLI', 'ILI', 'SNLI', 'SJLIC', 'SRLI', 
        'HLI', 'PMLI', 'BNL', 'BNT', 'HDL', 'NLO', 'UNL', 'SHIVM', 'SARBTM', 'SONA', 
        'GCIL', 'CBBL', 'DDBL', 'FMDBL', 'KMCDB', 'NLBBL', 'NUBL', 'SKBBL', 'SLBBL', 
        'SMFDB', 'SWBBL', 'MLBBL', 'LLBS', 'MMFDB', 'JSLBB', 'VLBS', 'NMBMF', 'MERO', 
        'NADEP', 'ALBSL', 'NMFBS', 'GMFBS', 'HLBSL', 'ILBS', 'FOWAD', 'SMATA', 'MSLB', 
        'GILB', 'SMB', 'GBLBS', 'NESDO', 'MLBSL', 'GLBSL', 'NICLBSL', 'SLBSL', 'RULB', 
        'UNLB', 'JBLB', 'SHLB', 'ULBSL', 'ADLB', 'SMFBS', 'WNLB', 'SAMAJ', 'DLBS', 
        'ANLB', 'MLBS', 'AVYAN', 'ACLBSL', 'USLB', 'NSLB', 'CYCL', 'KLBSL', 'SWMF', 
        'NMLBBL', 'MATRI', 'SMPDA', 'NEF', 'NMBHF1', 'LEMF', 'SEF', 'SAEF', 'NICGF', 
        'CMF1', 'NBF2', 'CMF2', 'NIBLSF', 'NMB50', 'SIGS2', 'NICBF', 'SFMF', 'LUK', 
        'NADDF', 'SLCF', 'KEF', 'SBCF', 'NIBSF2', 'PSF', 'NICSF', 'RMF1', 'MMF1', 'NBF3', 
        'KDBY', 'NICFC', 'GIBF1', 'NSIF2', 'SAGF', 'NIBLGF', 'SFEF', 'PRSF', 'SIGS3', 
        'C30MF', 'RMF2', 'LVF2', 'H8020', 'NIBLSTF', 'KSY', 'NICL', 'NIL', 'NLG', 'SICL', 
        'PRIN', 'RBCL', 'IGI', 'HEI', 'SGIC', 'SPIL', 'SALICO', 'UAIL', 'NTC', 'NRIC', 
        'HRL', 'MKCL', 'SJLICP', 'NRM', 'NWCL', 'NRICP', 'BBC', 'STC', 'SEBON'
        // Debt/Debenture/Pref. share/Right share/Other are intentionally excluded for brevity but can be added back
    ];

    let allStockData = [];
    let filteredData = [];
    let currentPage = 1;
    const pageSize = 5; // Increased page size for a better table view
    const previousLTP = {}; // store previous LTP to calculate change
    const symbolCache = {}; // { SYM: { data, fetchedAt } }
    const CACHE_TTL_MS = 30000; // 30s freshness
    let searchTimer = null; // debounce timer

    async function fetchStockData(symbol) {
        try {
            // Using a mock API path since the actual API is not provided
            const response = await fetch(`/api/stocks/${symbol}`);
            if (!response.ok) return null;
            const data = await response.json();

            // Calculate change from previous fetch/cache (simple implementation)
            const prevLTP = previousLTP[symbol] || data.previous_close || data.ltp; 
            const change = data.ltp ? (data.ltp - prevLTP) : 0;
            previousLTP[symbol] = data.ltp;

            return { ...data, change };
        } catch (error) {
            console.error('Error fetching data for', symbol, error);
            // Return existing data if fetch fails, but mark it as potentially stale
            const cached = symbolCache[symbol];
            return cached ? cached.data : null; 
        }
    }

    // Debounced search handler to avoid excessive actions while typing
    function handleSearchInput() {
        if (searchTimer) clearTimeout(searchTimer);
        searchTimer = setTimeout(() => {
            filterData();
        }, 300); // 300ms debounce
    }

    function filterData() {
        const searchQuery = document.getElementById('searchInput').value.toUpperCase();
        
        // Filter the symbol list
        filteredData = stockSymbols
            .filter(sym => sym.includes(searchQuery) || (symbolCache[sym]?.data?.company_name?.toUpperCase() ?? '').includes(searchQuery))
            .map(sym => ({ symbol: sym }));

        currentPage = 1;
        renderPagination();
        loadCurrentPage();
    }

    async function loadCurrentPage() {
        setLoading(true);
        const total = filteredData.length;
        const totalPages = Math.max(1, Math.ceil(total / pageSize));
        if (currentPage > totalPages && total > 0) currentPage = totalPages;

        const start = (currentPage - 1) * pageSize;
        const pageSyms = filteredData.slice(start, start + pageSize).map(x => x.symbol);

        // Fetch only current-page symbols, using cache when fresh
        const now = Date.now();
        const fetches = pageSyms.map(async sym => {
            const cached = symbolCache[sym];
            const fresh = cached && (now - cached.fetchedAt < CACHE_TTL_MS);
            if (fresh) return cached.data;
            
            // Placeholder: Simulate a slight delay for better loading UX
            // await new Promise(r => setTimeout(r, 50)); 
            
            const data = await fetchStockData(sym);
            if (data) {
                symbolCache[sym] = { data, fetchedAt: Date.now() };
                return data;
            }
            return cached ? cached.data : null; // fallback to stale if available
        });

        const results = await Promise.all(fetches);
        allStockData = results.filter(Boolean);
        renderTable(total, totalPages);
        setLoading(false);
    }

    function renderTable(total, totalPages) {
        const tableBody = document.getElementById('tableBody');
        tableBody.innerHTML = '';

        document.getElementById('stockCount').innerText = `${total} stocks found • Page ${currentPage} of ${totalPages}`;

        if (total === 0) {
            document.getElementById('noDataMessage').classList.remove('hidden');
            document.getElementById('tableContainer').classList.add('hidden');
            document.getElementById('pagination').innerHTML = '';
            return;
        } else {
            document.getElementById('noDataMessage').classList.add('hidden');
            document.getElementById('tableContainer').classList.remove('hidden');
        }

        allStockData.forEach(stock => {
            const changeValue = stock.change !== undefined && stock.change !== null ? stock.change : 0;
            const changeClass = changeValue > 0 ? 'text-green-600 font-bold' : (changeValue < 0 ? 'text-red-600 font-bold' : 'text-gray-500');
            const changeIcon = changeValue > 0 ? '▲' : (changeValue < 0 ? '▼' : '▬');
            const formattedChange = changeValue.toFixed(2);
            const timeString = stock.last_updated ? new Date(stock.last_updated).toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit', second: '2-digit' }) : '-';

            const row = `
                <tr class="transition-all duration-150 hover:bg-red-50/50 hover:shadow-inner cursor-pointer">
                    <td class="px-5 py-3 font-extrabold text-sm text-gray-800">${stock.symbol}</td>
                    <td class="px-5 py-3 text-sm text-gray-600 hidden sm:table-cell">${stock.company_name ?? '-'}</td>
                    <td class="px-5 py-3 text-sm text-right font-medium">${stock.ltp ? parseFloat(stock.ltp).toFixed(2) : '-'}</td>
                    
                    <td class="px-5 py-3 text-xs text-gray-500 hidden md:table-cell">${timeString}</td>
                </tr>
            `;
            tableBody.innerHTML += row;
        });
    }

    function renderPagination() {
        const total = filteredData.length;
        const totalPages = Math.max(1, Math.ceil(total / pageSize));
        const container = document.getElementById('pagination');
        container.innerHTML = '';

        if (totalPages <= 1) return;

        const btnClass = (active = false, disabled = false) => {
            let classes = 'h-8 w-8 flex items-center justify-center rounded-full text-xs font-semibold transition-colors duration-150';
            if (disabled) {
                classes += ' text-gray-400 bg-gray-100 cursor-not-allowed';
            } else if (active) {
                classes += ' bg-red-600 text-white shadow-lg shadow-red-500/50';
            } else {
                classes += ' text-gray-700 bg-white border border-gray-300 hover:bg-red-50';
            }
            return classes;
        };

        const btn = (label, disabled, onClick) => {
            const labelHtml = label === 'Prev' ? '<svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" /></svg>' : 
                              label === 'Next' ? '<svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>' : 
                              label;
            return `
                <button ${disabled ? 'disabled' : ''}
                    class="${btnClass(false, disabled)}"
                    ${disabled ? '' : `onclick="(function(){ ${onClick} })();"`}>
                    ${labelHtml}
                </button>`;
        };

        // Prev Button
        container.innerHTML += btn('Prev', currentPage === 1, 'currentPage--; loadCurrentPage(); renderPagination();');

        // Page Buttons
        const maxButtons = 5;
        let start = Math.max(1, currentPage - Math.floor(maxButtons/2));
        let end = Math.min(totalPages, start + maxButtons - 1);
        // Recalculate start to ensure we always show `maxButtons` if possible
        start = Math.max(1, end - maxButtons + 1);

        for (let p = start; p <= end; p++) {
            container.innerHTML += `
                <button class="${btnClass(p === currentPage)}" 
                        onclick="(function(){ currentPage=${p}; loadCurrentPage(); renderPagination(); })()">
                    ${p}
                </button>`;
        }

        // Next Button
        container.innerHTML += btn('Next', currentPage === totalPages, 'currentPage++; loadCurrentPage(); renderPagination();');
    }

    function setLoading(flag) {
        // isLoading = flag; // Assuming 'isLoading' is global or intentionally omitted
        const el = document.getElementById('stockCount');
        if (flag) {
            el.innerHTML = '<span class="inline-flex items-center gap-2 text-red-500"><svg class="animate-spin h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path></svg> Fetching Data...</span>';
        }
        // else: the count is updated in renderTable
    }

    // Initial load
    filterData();

    // Refresh only currently visible page every 60 seconds
    setInterval(() => { loadCurrentPage(); }, 60000);
</script>