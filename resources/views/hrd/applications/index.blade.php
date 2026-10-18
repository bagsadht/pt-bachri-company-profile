@extends('admin.layout')
@section('title', 'Lamaran Masuk')

@section('content')

<style>
/* ============================================================
   VARIABEL & RESET
   ============================================================ */
.hrd-page {
    --h-bg:     #0b1222;
    --h-blue:   #0d6efd;
    --h-indigo: #4f46e5;
    --h-cyan:   #22d3ee;
    --h-text:   #e8eeff;
    --h-muted:  #94a3c4;
    --h-soft:   #7f95c9;
    --h-line:   rgba(255,255,255,.10);
    --h-green:  #10b981;
    --h-red:    #fb7185;
    --h-amber:  #f59e0b;

    position: relative;
    isolation: isolate;
    padding: 1.75rem;
    border-radius: 24px;
    min-height: 100%;
    overflow: hidden;
    color: var(--h-text);
    font-family: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
    background:
        radial-gradient(1200px 700px at 15% 0%,    #17275a 0%, transparent 55%),
        radial-gradient(900px  600px at 100% 100%, #1b1a5e 0%, transparent 55%),
        var(--h-bg);
}
.hrd-page > * { position: relative; z-index: 1; }

.hrd-page::before {
    content: "";
    position: absolute;
    inset: 0;
    z-index: 0;
    pointer-events: none;
    background-image: radial-gradient(rgba(255,255,255,.045) 1px, transparent 1px);
    background-size: 26px 26px;
    -webkit-mask-image: radial-gradient(ellipse at center, #000 25%, transparent 80%);
            mask-image: radial-gradient(ellipse at center, #000 25%, transparent 80%);
}

/* ---------- BLOB DEKORATIF ---------- */
.hrd-blob {
    position: absolute;
    border-radius: 50%;
    filter: blur(80px);
    opacity: .38;
    pointer-events: none;
    z-index: 0;
}
.hrd-blob.b1 { width: 380px; height: 380px; background: var(--h-blue);   top: -150px;    left: -110px;  animation: hb1 18s ease-in-out infinite; }
.hrd-blob.b2 { width: 340px; height: 340px; background: var(--h-indigo); bottom: -170px; right: -90px;  animation: hb2 22s ease-in-out infinite; }
.hrd-blob.b3 { width: 240px; height: 240px; background: var(--h-cyan);   top: 45%;       left: 55%;     opacity: .16; animation: hb3 26s ease-in-out infinite; }

@keyframes hb1 { 50% { transform: translate(80px, 60px)   scale(1.15); } }
@keyframes hb2 { 50% { transform: translate(-90px, -55px) scale(1.12); } }
@keyframes hb3 { 50% { transform: translate(-50px, 70px)  scale(.9);   } }

/* ---------- HEADER & SEARCH ---------- */
.hrd-head {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    flex-wrap: wrap;
    gap: 1.25rem;
    margin-bottom: 1.6rem;
    animation: h-enter .5s cubic-bezier(.2,.7,.2,1) both;
}
.hrd-title {
    margin: 0;
    font-size: 1.7rem;
    font-weight: 800;
    letter-spacing: -.03em;
    background: linear-gradient(120deg, #fff 15%, #a5c4ff 55%, #67e8f9 100%);
    -webkit-background-clip: text;
            background-clip: text;
    color: transparent;
}
.hrd-sub { margin: .4rem 0 0; font-size: .9rem; color: var(--h-muted); }

.hrd-toolbar { display: flex; gap: .6rem; align-items: center; flex-wrap: wrap; }
.hrd-search-field { position: relative; }
.hrd-search input {
    width: 260px;
    height: 44px;
    padding: 0 1rem 0 2.6rem;
    font: inherit;
    font-size: .88rem;
    color: #fff;
    background: rgba(7,12,28,.55);
    border: 1.5px solid var(--h-line);
    border-radius: 12px;
    outline: none;
    transition: all .2s;
}
.hrd-search input::placeholder { color: #5f739f; }
.hrd-search input:focus {
    border-color: #60a5fa;
    background: rgba(7,12,28,.85);
    box-shadow: 0 0 0 4px rgba(59,130,246,.18);
}
.hrd-search .ico {
    position: absolute;
    left: .95rem;
    top: 50%;
    transform: translateY(-50%);
    font-size: .82rem;
    color: #6f84b3;
    pointer-events: none;
    transition: color .2s;
}
.hrd-search-field:focus-within .ico { color: #60a5fa; }

/* ---------- TABLE CARD ---------- */
.hrd-card {
    border-radius: 20px;
    overflow: hidden;
    background: linear-gradient(160deg, rgba(255,255,255,.06), rgba(255,255,255,.02));
    border: 1px solid var(--h-line);
    backdrop-filter: blur(18px) saturate(140%);
    -webkit-backdrop-filter: blur(18px) saturate(140%);
    box-shadow: 0 24px 60px -30px rgba(0,0,0,.8), inset 0 1px 0 rgba(255,255,255,.08);
    animation: h-enter .5s .1s cubic-bezier(.2,.7,.2,1) both;
}
.hrd-table { width: 100%; border-collapse: collapse; }

.hrd-table thead th {
    padding: 1rem 1.25rem;
    font-size: .72rem;
    font-weight: 700;
    letter-spacing: .08em;
    text-transform: uppercase;
    color: var(--h-soft);
    text-align: left;
    white-space: nowrap;
    background: rgba(255,255,255,.03);
    border-bottom: 1px solid var(--h-line);
}
.hrd-table thead th.r { text-align: right; }
.hrd-table tbody tr {
    border-bottom: 1px solid rgba(255,255,255,.05);
    transition: background .18s ease;
}
.hrd-table tbody tr:last-child { border-bottom: 0; }
.hrd-table tbody tr:hover { background: rgba(96,165,250,.06); }

.hrd-table td {
    padding: 1.1rem 1.25rem;
    font-size: .88rem;
    color: #cbd5e1;
    vertical-align: middle;
}
.cell-no { width: 60px; font-size: .82rem; font-weight: 600; color: #6f84b3; }

/* ---------- CELL: NAMA ---------- */
.cell-name { display: flex; align-items: center; gap: .9rem; }
.avatar {
    width: 42px;
    height: 42px;
    flex-shrink: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: .9rem;
    font-weight: 800;
    color: #fff;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--h-blue), var(--h-indigo));
    box-shadow: 0 0 0 2px rgba(255,255,255,.10), 0 8px 18px -8px rgba(79,70,229,.85);
}
.name-txt  { font-size: .92rem; font-weight: 700; color: #f1f5f9; }
.name-date { display: flex; align-items: center; gap: .35rem; margin-top: 3px; font-size: .74rem; color: var(--h-soft); }

/* ---------- CELL: POSISI ---------- */
.tag-pos {
    display: inline-flex;
    align-items: center;
    padding: .35rem .75rem;
    font-size: .75rem;
    font-weight: 600;
    color: #a5c4ff;
    background: rgba(96,165,250,.14);
    border: 1px solid rgba(96,165,250,.28);
    border-radius: 8px;
    white-space: nowrap;
}

/* ---------- CELL: STATUS PILL ---------- */
.pill {
    display: inline-flex;
    align-items: center;
    gap: .5rem;
    padding: .38rem .8rem;
    font-size: .75rem;
    font-weight: 600;
    border-radius: 999px;
    white-space: nowrap;
}
.pill .dot {
    position: relative;
    width: 6px;
    height: 6px;
    border-radius: 50%;
}
.pill.orange { color: #fcd34d; background: rgba(245,158,11,.12); border: 1px solid rgba(245,158,11,.3); }
.pill.orange .dot { background: var(--h-amber); box-shadow: 0 0 8px var(--h-amber); }
.pill.orange .dot::after {
    content: "";
    position: absolute;
    inset: -4px;
    border-radius: 50%;
    border: 1px solid currentColor;
    animation: h-ping 1.8s ease-out infinite;
}
@keyframes h-ping {
    0%   { transform: scale(.7); opacity: .9; }
    100% { transform: scale(2.2); opacity: 0; }
}

/* ---------- CELL: AKSI ---------- */
.row-actions { display: inline-flex; gap: .45rem; }
.icon-btn {
    position: relative;
    overflow: hidden;
    width: 36px;
    height: 36px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: .85rem;
    color: #a9b8d8;
    background: rgba(255,255,255,.04);
    border: 1px solid var(--h-line);
    border-radius: 10px;
    cursor: pointer;
    text-decoration: none;
    transition: all .18s ease;
}
.icon-btn:hover {
    color: #fff;
    transform: translateY(-2px);
    background: rgba(96,165,250,.16);
    border-color: rgba(96,165,250,.42);
    box-shadow: 0 8px 18px -8px rgba(96,165,250,.7);
}
.icon-btn.danger:hover  { color: #fda4af; background: rgba(251,113,133,.16); border-color: rgba(251,113,133,.42); }
.icon-btn.success:hover { color: #6ee7b7; background: rgba(16,185,129,.16);  border-color: rgba(16,185,129,.42); }
.icon-btn.warning:hover { color: #fcd34d; background: rgba(245,158,11,.16);   border-color: rgba(245,158,11,.42); }

/* ---------- EMPTY STATE & PAGINATION ---------- */
.empty { padding: 4rem 1rem; text-align: center; color: var(--h-muted); }
.empty .ic {
    width: 76px;
    height: 76px;
    margin: 0 auto 1.1rem;
    display: grid;
    place-items: center;
    font-size: 1.8rem;
    color: #60a5fa;
    background: rgba(96,165,250,.10);
    border: 1px solid rgba(96,165,250,.22);
    border-radius: 22px;
    animation: h-pulse 3s ease-in-out infinite;
}
@keyframes h-pulse { 50% { box-shadow: 0 0 0 12px rgba(96,165,250,.08); } }
.empty h3 { margin: 0 0 .35rem; font-size: 1rem; font-weight: 700; color: #cbd5e1; }
.empty p  { margin: 0; font-size: .86rem; }

.hrd-pagination {
    margin-top: 1.5rem;
    display: flex;
    justify-content: center;
    animation: h-enter .5s .15s cubic-bezier(.2,.7,.2,1) both;
}
.hrd-pagination .pagination { display: flex; gap: .3rem; margin: 0; padding: 0; list-style: none; }
.hrd-pagination .page-item .page-link {
    min-width: 40px;
    padding: .55rem .9rem;
    font-size: .82rem;
    font-weight: 600;
    text-align: center;
    text-decoration: none;
    color: #a9b8d8;
    background: rgba(255,255,255,.04);
    border: 1px solid var(--h-line);
    border-radius: 10px;
    transition: all .18s;
}
.hrd-pagination .page-item .page-link:hover {
    color: #fff;
    background: rgba(96,165,250,.14);
    border-color: rgba(96,165,250,.42);
}
.hrd-pagination .page-item.active .page-link {
    color: #fff;
    border-color: transparent;
    background: linear-gradient(135deg, var(--h-blue), var(--h-indigo));
    box-shadow: 0 10px 22px -10px rgba(79,70,229,.9);
}
.hrd-pagination .page-item.disabled .page-link { opacity: .35; }

/* ============================================================
   MODAL PROFESIONAL (DARK THEME)
   ============================================================ */
.iv-modal {
    position: fixed;
    inset: 0;
    z-index: 9999;
    background: rgba(2, 6, 23, 0.8);
    backdrop-filter: blur(4px);
    -webkit-backdrop-filter: blur(4px);
    display: none;
    align-items: center;
    justify-content: center;
    padding: 1.5rem;
}
.iv-modal.open { display: flex; }

.iv-modal__box {
    width: 100%;
    max-width: 600px;
    max-height: 90vh;
    overflow-y: auto;
    background: #0f172a; /* Warna dasar slate-900 */
    border: 1px solid #1e293b;
    border-radius: 12px;
    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
    display: flex;
    flex-direction: column;
    animation: modalIn 0.2s ease-out;
}
@keyframes modalIn {
    from { opacity: 0; transform: scale(0.98) translateY(10px); }
    to { opacity: 1; transform: scale(1) translateY(0); }
}

/* ---------- HEADER MODAL ---------- */
.iv-modal__head {
    padding: 1.5rem;
    border-bottom: 1px solid #1e293b;
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    gap: 1rem;
}
.iv-modal__title {
    margin: 0;
    font-size: 1.15rem;
    font-weight: 600;
    color: #f8fafc;
    letter-spacing: -0.01em;
}
.iv-modal__sub {
    margin: 6px 0 0;
    font-size: 0.85rem;
    color: #94a3b8;
}
.iv-modal__sub strong {
    color: #cbd5e1;
    font-weight: 500;
}
.iv-modal__close {
    width: 32px;
    height: 32px;
    display: grid;
    place-items: center;
    background: transparent;
    border: 1px solid transparent;
    border-radius: 6px;
    color: #64748b;
    cursor: pointer;
    transition: all 0.2s;
}
.iv-modal__close:hover {
    background: #1e293b;
    color: #f8fafc;
}

/* ---------- BODY MODAL ---------- */
.iv-modal__body {
    padding: 1.5rem;
    display: grid;
    gap: 1.25rem;
    overflow-y: auto;
}
.iv-modal__box::-webkit-scrollbar { width: 8px; }
.iv-modal__box::-webkit-scrollbar-track { background: transparent; }
.iv-modal__box::-webkit-scrollbar-thumb { background: #334155; border-radius: 4px; }
.iv-modal__box::-webkit-scrollbar-thumb:hover { background: #475569; }

/* ---------- FORM FIELDS ---------- */
.iv-field { display: flex; flex-direction: column; gap: 6px; }
.iv-field label {
    font-size: 0.85rem;
    font-weight: 500;
    color: #cbd5e1;
    display: flex;
    align-items: center;
    gap: 6px;
}
.iv-field label i { color: #64748b; font-size: 0.9rem; width: 14px; text-align: center; }
.iv-field .req { color: #ef4444; margin-left: 2px; }

.iv-input, .iv-textarea {
    width: 100%;
    padding: 0.65rem 0.85rem;
    font-family: inherit;
    font-size: 0.9rem;
    color: #f8fafc;
    background: #020617; /* Lebih gelap dari background modal */
    border: 1px solid #334155;
    border-radius: 8px;
    outline: none;
    transition: border-color 0.2s, box-shadow 0.2s;
}
.iv-input { height: 42px; }
.iv-textarea { resize: vertical; min-height: 100px; line-height: 1.5; }

.iv-input:focus, .iv-textarea:focus {
    border-color: #3b82f6;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.15);
}
.iv-input:disabled {
    background: #0f172a;
    color: #64748b;
    cursor: not-allowed;
    border-color: #1e293b;
}
.iv-input::placeholder, .iv-textarea::placeholder { color: #475569; }
.iv-row { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }

/* ---------- FOOTER & BUTTONS ---------- */
.iv-modal__foot {
    padding: 1.25rem 1.5rem;
    border-top: 1px solid #1e293b;
    background: #0b1120;
    display: flex;
    justify-content: flex-end;
    gap: 0.75rem;
    border-radius: 0 0 12px 12px;
}
.iv-btn {
    height: 40px;
    padding: 0 1.25rem;
    font-size: 0.9rem;
    font-weight: 500;
    border-radius: 8px;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    transition: all 0.2s;
}
.iv-btn.ghost {
    background: transparent;
    border: 1px solid #334155;
    color: #cbd5e1;
}
.iv-btn.ghost:hover {
    background: #1e293b;
    color: #f8fafc;
}
.iv-btn.submit {
    background: #3b82f6;
    border: 1px solid #2563eb;
    color: #fff;
}
.iv-btn.submit:hover {
    background: #2563eb;
}
.iv-btn.submit:disabled {
    opacity: 0.6;
    cursor: not-allowed;
}

/* ---------- ANIMASI & RESPONSIF ---------- */
@keyframes h-enter {
    from { opacity: 0; transform: translateY(12px); }
    to   { opacity: 1; transform: none; }
}
@media (prefers-reduced-motion: reduce) {
    .hrd-page *, .hrd-page *::before, .hrd-page *::after {
        animation: none !important;
        transition: none !important;
    }
}
@media (max-width: 768px) {
    .hrd-page          { padding: 1.25rem; border-radius: 18px; }
    .hrd-title         { font-size: 1.35rem; }
    .hrd-search input  { width: 100%; }
    .hrd-search-field  { flex: 1; }
    .hrd-toolbar       { width: 100%; }
    .hrd-table thead th{ padding: .8rem .9rem; }
    .hrd-table td      { padding: .9rem; }
    .iv-row            { grid-template-columns: 1fr; }
}
</style>


{{-- ============================================================
     KONTEN
     ============================================================ --}}
<div class="hrd-page">

    <span class="hrd-blob b1" aria-hidden="true"></span>
    <span class="hrd-blob b2" aria-hidden="true"></span>
    <span class="hrd-blob b3" aria-hidden="true"></span>

    {{-- ---------- HEADER ---------- --}}
    <div class="hrd-head">
        <div>
            <h1 class="hrd-title">Lamaran Masuk</h1>
            <p class="hrd-sub">Tinjau lamaran baru dan tentukan apakah lanjut ke proses seleksi.</p>
        </div>

        <form method="GET" class="hrd-toolbar">
            <div class="hrd-search-field hrd-search">
                <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari nama, posisi..." autocomplete="off">
                <i class="fa-solid fa-magnifying-glass ico"></i>
            </div>
        </form>
    </div>

    {{-- ---------- TABEL ---------- --}}
    <div class="hrd-card">
        <div class="table-responsive">
            <table class="hrd-table">
                <thead>
                    <tr>
                        <th style="width:60px;">No</th>
                        <th>Nama Pelamar</th>
                        <th>Posisi</th>
                        <th>Tanggal Masuk</th>
                        <th>Status</th>
                        <th class="r">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($applications as $a)
                    <tr>
                        <td class="cell-no">{{ $applications->firstItem() + $loop->index }}</td>

                        {{-- Nama --}}
                        <td>
                            <div class="cell-name">
                                <div class="avatar">{{ strtoupper(substr($a->nama, 0, 1)) }}</div>
                                <div>
                                    <div class="name-txt">{{ $a->nama }}</div>
                                    <div class="name-date">
                                        <i class="fa-regular fa-envelope" style="font-size:.7rem;"></i>
                                        {{ $a->email }}
                                    </div>
                                </div>
                            </div>
                        </td>

                        {{-- Posisi --}}
                        <td><span class="tag-pos">{{ $a->vacancy->judul ?? '-' }}</span></td>

                        {{-- Tanggal --}}
                        <td>
                            <div style="font-size:.85rem;color:#b6c2e2;">{{ $a->created_at->format('d M Y') }}</div>
                        </td>

                        {{-- Status --}}
                        <td>
                            <span class="pill orange">
                                <span class="dot"></span> Kontak Masuk
                            </span>
                        </td>

                        {{-- Aksi --}}
                        <td style="text-align:right;white-space:nowrap;">
                            <div class="row-actions">

                                {{-- Lihat Berkas (CV) --}}
                                <a href="{{ route('hrd.applications.cv', $a) }}"
                                   class="icon-btn" title="Lihat/Unduh Berkas">
                                    <i class="fa-regular fa-file-lines"></i>
                                </a>

                                {{-- Lanjut ke Proses Seleksi (Buka Modal Jadwal) --}}
                                <button type="button"
                                        class="icon-btn success"
                                        title="Lanjut ke Proses Seleksi"
                                        onclick='openInterviewModal(
                                            {{ $a->id }},
                                            @json($a->nama),
                                            @json($a->vacancy->judul ?? "-")
                                        )'>
                                    <i class="fa-solid fa-check"></i>
                                </button>

                                {{-- Tolak --}}
                                <form action="{{ route('hrd.applications.update', $a) }}"
                                      method="POST" style="display:inline;margin:0;"
                                      data-confirm="Tandai {{ $a->nama }} sebagai TIDAK LOLOS?"
                                      data-confirm-type="warning"
                                      data-confirm-text="Ya, Tandai Gagal">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="ditolak">
                                    <button type="submit" class="icon-btn warning" title="Tolak Lamaran">
                                        <i class="fa-solid fa-xmark"></i>
                                    </button>
                                </form>

                                {{-- Hapus --}}
                                <form action="{{ route('hrd.applications.destroy', $a) }}"
                                      method="POST" style="display:inline;margin:0;"
                                      data-confirm="Hapus data lamaran ini secara permanen?"
                                      data-confirm-type="danger"
                                      data-confirm-text="Ya, Hapus">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="icon-btn danger" title="Hapus">
                                        <i class="fa-regular fa-trash-can"></i>
                                    </button>
                                </form>

                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="padding:0;border:0;">
                            <div class="empty">
                                <div class="ic"><i class="fa-regular fa-envelope-open"></i></div>
                                <h3>Belum Ada Lamaran Baru</h3>
                                <p>Semua lamaran sudah diproses. Kerja bagus! ✨</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- ---------- PAGINATION ---------- --}}
    @if($applications->hasPages())
        <div class="hrd-pagination">
            {{ $applications->links('pagination::bootstrap-5') }}
        </div>
    @endif

    {{-- ============================================================
         MODAL 1: Jadwal Interview (Profesional)
         ============================================================ --}}
    <div id="interviewModal" class="iv-modal" role="dialog" aria-modal="true">
        <div class="iv-modal__box">
            <div class="iv-modal__head">
                <div>
                    <h3 class="iv-modal__title">Jadwalkan Interview &amp; Tes</h3>
                    <p class="iv-modal__sub">Kirim undangan ke: <strong id="ivModalName">—</strong></p>
                </div>
                <button type="button" class="iv-modal__close" onclick="closeInterviewModal()">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <form id="interviewForm" method="POST" action="">
                @csrf
                @method('PATCH')
                <input type="hidden" name="status" value="diproses">

                <div class="iv-modal__body">
                    <div class="iv-field">
                        <label>Posisi Dilamar</label>
                        <input type="text" id="ivModalPosition" class="iv-input" disabled>
                    </div>

                    <div class="iv-row">
                        <div class="iv-field">
                            <label><i class="fa-regular fa-calendar"></i> Tanggal <span class="req">*</span></label>
                            <input type="date" name="interview_date" class="iv-input" required
                                   min="{{ now()->format('Y-m-d') }}"
                                   value="{{ now()->addDay()->format('Y-m-d') }}">
                        </div>
                        <div class="iv-field">
                            <label><i class="fa-regular fa-clock"></i> Jam <span class="req">*</span></label>
                            <input type="time" name="interview_time" class="iv-input" required value="09:00">
                        </div>
                    </div>

                    <div class="iv-field">
                        <label><i class="fa-solid fa-location-dot"></i> Lokasi <span class="req">*</span></label>
                        <input type="text" name="interview_location" class="iv-input" required
                               value="Kantor PT Bachri Samudera Indonesia">
                    </div>

                    <div class="iv-field">
                        <label><i class="fa-regular fa-note-sticky"></i> Catatan Tambahan <span style="color:#64748b;font-weight:400;">(opsional)</span></label>
                        <textarea name="interview_note" class="iv-textarea" rows="3"
                                  placeholder="Contoh: Bawa laptop dan berpakaian formal."></textarea>
                    </div>
                </div>

                <div class="iv-modal__foot">
                    <button type="button" class="iv-btn ghost" onclick="closeInterviewModal()">Batal</button>
                    <button type="submit" class="iv-btn submit">
                        <i class="fa-regular fa-paper-plane"></i> Kirim Undangan
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>


{{-- ============================================================
     SCRIPT
     ============================================================ --}}
<script>
(function () {
    'use strict';

    /* ---------- Ripple Effect ---------- */
    document.querySelectorAll('.icon-btn').forEach(function (el) {
        el.addEventListener('click', function (e) {
            const rect = el.getBoundingClientRect();
            const size = Math.max(rect.width, rect.height);
            const span = document.createElement('span');

            span.style.cssText =
                'position:absolute;border-radius:50%;background:rgba(255,255,255,.4);' +
                'transform:scale(0);animation:h-ripple .6s ease-out;pointer-events:none;' +
                'width:'  + size + 'px;' +
                'height:' + size + 'px;' +
                'left:'   + (e.clientX - rect.left - size / 2) + 'px;' +
                'top:'    + (e.clientY - rect.top  - size / 2) + 'px;';

            el.appendChild(span);
            setTimeout(function () { span.remove(); }, 600);
        });
    });

    /* ---------- Modal Jadwal Interview ---------- */
    const modal  = document.getElementById('interviewModal');
    const form   = document.getElementById('interviewForm');
    const nameEl = document.getElementById('ivModalName');
    const posEl  = document.getElementById('ivModalPosition');

    window.openInterviewModal = function (id, nama, posisi) {
        nameEl.textContent = nama;
        posEl.value        = posisi;
        
        // Arahkan form ke route yang benar
        form.action        = '/hrd/lamaran/' + id;

        modal.classList.add('open');
        document.body.style.overflow = 'hidden';
    };

    window.closeInterviewModal = function () {
        modal.classList.remove('open');
        document.body.style.overflow = '';
    };

    modal.addEventListener('click', function (e) {
        if (e.target === modal) closeInterviewModal();
    });

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && modal.classList.contains('open')) closeInterviewModal();
    });
    
    /* Tambahkan keyframes ripple jika belum ada di layout */
    if (!document.getElementById('ripple-style')) {
        const style = document.createElement('style');
        style.id = 'ripple-style';
        style.innerHTML = '@keyframes h-ripple { to { transform: scale(4); opacity: 0; } }';
        document.head.appendChild(style);
    }
})();
</script>

@endsection