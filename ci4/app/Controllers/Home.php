<?php

namespace App\Controllers;

class Home extends BaseController
{
	public function visitor()
	{
		//Get Datetime now
		$dt        = date("Y-m-d");
		$tm 	   = date("H:i:s");

		//Get IP
		if (!empty($_SERVER['HTTP_CLIENT_IP']))   //Checking IP From Shared Internet
		{
			$ip = $_SERVER['HTTP_CLIENT_IP'];
		}
		elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //To Check IP is Pass From Proxy
		{
			$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		}
		else
		{
			$ip = $_SERVER['REMOTE_ADDR'];
		}

		$cek_visitor			= $this->visitor->cek_visitor($dt, $ip);
		if ($cek_visitor == 0) {
			$visitor = [
				'visitor_ip'      	=> $ip,
				'visitor_dt'        => $dt,
				'visitor_tm'        => $tm,
			];
			$this->visitor->insert($visitor);
		}
	}

	public function not_found()
	{
		$this->cachePage(360);
		
		$nomor_telepon          = $this->informasi->find(1);
		$email                  = $this->informasi->find(2);
		$alamat                 = $this->informasi->find(3);
		$facebook               = $this->informasi->find(4);
		$twitter                = $this->informasi->find(5);
		$instagram              = $this->informasi->find(6);
		$youtube                = $this->informasi->find(7);
		$jam_senin_kamis        = $this->informasi->find(8);
		$jam_jumat              = $this->informasi->find(9);
		$jam_sabtu_minggu       = $this->informasi->find(10);
		$wa_akta                = $this->informasi->find(11);
		$wa_ktp                 = $this->informasi->find(12);
		$wa_pengaduan           = $this->informasi->find(13);

		$data = [
			'layanan_kategori' 		=> $this->layanan_kategori->list(),
			'nomor_telepon'         => $nomor_telepon['informasi_value'],
			'email'                 => $email['informasi_value'],
			'alamat'                => $alamat['informasi_value'],
			'facebook'              => $facebook['informasi_value'],
			'twitter'               => $twitter['informasi_value'],
			'instagram'             => $instagram['informasi_value'],
			'youtube'               => $youtube['informasi_value'],
			'jam_senin_kamis'       => $jam_senin_kamis['informasi_value'],
			'jam_jumat'             => $jam_jumat['informasi_value'],
			'jam_sabtu_minggu'      => $jam_sabtu_minggu['informasi_value'],
			'wa_akta'               => $wa_akta['informasi_value'],
			'wa_ktp'                => $wa_ktp['informasi_value'],
			'wa_pengaduan'          => $wa_pengaduan['informasi_value'],
		];
		return view('halaman/404', $data);
	}

	public function index()
	{
		$this->visitor();
		$nomor_telepon          = $this->informasi->find(1);
		$email                  = $this->informasi->find(2);
		$alamat                 = $this->informasi->find(3);
		$facebook               = $this->informasi->find(4);
		$twitter                = $this->informasi->find(5);
		$instagram              = $this->informasi->find(6);
		$youtube                = $this->informasi->find(7);
		$jam_senin_kamis        = $this->informasi->find(8);
		$jam_jumat              = $this->informasi->find(9);
		$jam_sabtu_minggu       = $this->informasi->find(10);
		$wa_akta                = $this->informasi->find(11);
		$wa_ktp                 = $this->informasi->find(12);
		$wa_pengaduan           = $this->informasi->find(13);
		$jp_jenkel              = $this->informasi->find(14);
		$jp_wajib_ktp_jenkel    = $this->informasi->find(15);
		$jp_kepemilikan_kk      = $this->informasi->find(16);
		$jp_update      		= $this->informasi->find(17);
		$foto_walkot      		= $this->profil->find(13);
		$foto_wakil     		= $this->profil->find(14);
		$nama_walkot_wakil      = $this->profil->find(15);
		$tes3              	 	= $this->visitor->count_visitor_bulan_ini();
        $visitor_bulanini   	= $tes3['0']['bulanini'];
        $visitor_total      	= $tes3['0']['total'];
        $visitor_tahunini   	= $this->visitor->count_visitor_tahun_ini();
        $visitor_hariini    	= $this->visitor->count_visitor_hari_ini();

		$data = [
			'visitor_hariini'  		=> $visitor_hariini,
            'visitor_bulanini'  	=> $visitor_bulanini,
            'visitor_tahunini'  	=> $visitor_tahunini,
            'visitor_total'     	=> $visitor_total,
			'layanan_kategori' 		=> $this->layanan_kategori->list(),
			'layanan' 				=> $this->layanan->list(),
			'galeri'      			=> $this->galeri->list_top3(),
			'berita'      			=> $this->berita->list_top6(),
			'pengumuman'  			=> $this->pengumuman->list_top3(),
			'link'        			=> $this->link->list(),
			'berita_pin'			=> $this->berita->berita_pin(),
			'pengumuman_pin'		=> $this->pengumuman->pengumuman_pin(),
			'penghargaan_pin'		=> $this->penghargaan->penghargaan_pin(),
			'nomor_telepon'         => $nomor_telepon['informasi_value'],
			'email'                 => $email['informasi_value'],
			'alamat'                => $alamat['informasi_value'],
			'facebook'              => $facebook['informasi_value'],
			'twitter'               => $twitter['informasi_value'],
			'instagram'             => $instagram['informasi_value'],
			'youtube'               => $youtube['informasi_value'],
			'jam_senin_kamis'       => $jam_senin_kamis['informasi_value'],
			'jam_jumat'             => $jam_jumat['informasi_value'],
			'jam_sabtu_minggu'      => $jam_sabtu_minggu['informasi_value'],
			'wa_akta'               => $wa_akta['informasi_value'],
			'wa_ktp'                => $wa_ktp['informasi_value'],
			'wa_pengaduan'          => $wa_pengaduan['informasi_value'],
			'jp_jenkel'             => $jp_jenkel['informasi_value'],
			'jp_wajib_ktp_jenkel'   => $jp_wajib_ktp_jenkel['informasi_value'],
			'jp_kepemilikan_kk'     => $jp_kepemilikan_kk['informasi_value'],
			'jp_update'     		=> $jp_update['informasi_value'],
			'foto_walkot'			=> $foto_walkot['profil_value'],
			'foto_wakil'			=> $foto_wakil['profil_value'],
			'nama_walkot_wakil'		=> $nama_walkot_wakil['profil_value'],
		];
		return view('index', $data);
	}

    public function galeri()
    {
		$this->visitor();
		$galeri = 'tb_galeri';
		$nomor_telepon          = $this->informasi->find(1);
		$email                  = $this->informasi->find(2);
		$alamat                 = $this->informasi->find(3);
		$facebook               = $this->informasi->find(4);
		$twitter                = $this->informasi->find(5);
		$instagram              = $this->informasi->find(6);
		$youtube                = $this->informasi->find(7);
		$jam_senin_kamis        = $this->informasi->find(8);
		$jam_jumat              = $this->informasi->find(9);
		$jam_sabtu_minggu       = $this->informasi->find(10);
		$wa_akta                = $this->informasi->find(11);
		$wa_ktp                 = $this->informasi->find(12);
		$wa_pengaduan           = $this->informasi->find(13);
		$jp_jenkel              = $this->informasi->find(14);
		$jp_wajib_ktp_jenkel    = $this->informasi->find(15);
		$jp_kepemilikan_kk      = $this->informasi->find(16);
		$data = [
			'layanan_kategori' 		=> $this->layanan_kategori->list(),
			'title'					=> 'Galeri Dispendukcapil Kota Mojokerto',
			'galeri'				=> $this->galeri->orderBy('galeri_id', 'DESC')->paginate(9, $galeri),
			'pager'		 			=> $this->galeri->pager,
			'facebook'              => $facebook['informasi_value'],
			'twitter'               => $twitter['informasi_value'],
			'instagram'             => $instagram['informasi_value'],
			'youtube'               => $youtube['informasi_value'],
			'nomor_telepon'         => $nomor_telepon['informasi_value'],
			'email'                 => $email['informasi_value'],
			'alamat'                => $alamat['informasi_value'],
			'facebook'              => $facebook['informasi_value'],
			'twitter'               => $twitter['informasi_value'],
			'instagram'             => $instagram['informasi_value'],
			'youtube'               => $youtube['informasi_value'],
			'jam_senin_kamis'       => $jam_senin_kamis['informasi_value'],
			'jam_jumat'             => $jam_jumat['informasi_value'],
			'jam_sabtu_minggu'      => $jam_sabtu_minggu['informasi_value'],
			'wa_akta'               => $wa_akta['informasi_value'],
			'wa_ktp'                => $wa_ktp['informasi_value'],
			'wa_pengaduan'          => $wa_pengaduan['informasi_value'],
			'jp_jenkel'             => $jp_jenkel['informasi_value'],
			'jp_wajib_ktp_jenkel'   => $jp_wajib_ktp_jenkel['informasi_value'],
			'jp_kepemilikan_kk'     => $jp_kepemilikan_kk['informasi_value'],
		];
        return view('galeri', $data);
    }

    public function single_galeri($galeri_slug)
    {
		$this->visitor();
		$cek 		= $this->galeri->cek_single_galeri($galeri_slug);

		if ($cek == 1) {
			$galeri 				= $this->galeri->single_galeri($galeri_slug);
			$galeri_id				= $galeri->galeri_id;
			$galeri_nama			= $galeri->galeri_nama;
			$list_foto				= $this->galeri_foto->single_galeri($galeri_id);
			$nomor_telepon          = $this->informasi->find(1);
			$email                  = $this->informasi->find(2);
			$alamat                 = $this->informasi->find(3);
			$facebook               = $this->informasi->find(4);
			$twitter                = $this->informasi->find(5);
			$instagram              = $this->informasi->find(6);
			$youtube                = $this->informasi->find(7);
			$jam_senin_kamis        = $this->informasi->find(8);
			$jam_jumat              = $this->informasi->find(9);
			$jam_sabtu_minggu       = $this->informasi->find(10);
			$wa_akta                = $this->informasi->find(11);
			$wa_ktp                 = $this->informasi->find(12);
			$wa_pengaduan           = $this->informasi->find(13);
			$jp_jenkel              = $this->informasi->find(14);
			$jp_wajib_ktp_jenkel    = $this->informasi->find(15);
			$jp_kepemilikan_kk      = $this->informasi->find(16);
			$data = [
				'layanan_kategori' 		=> $this->layanan_kategori->list(),
				'title'					=> 'Galeri - ' . $galeri_nama,
				'galeri'				=> $galeri,
				'list_foto'				=> $list_foto,
				'nomor_telepon'         => $nomor_telepon['informasi_value'],
				'email'                 => $email['informasi_value'],
				'alamat'                => $alamat['informasi_value'],
				'facebook'              => $facebook['informasi_value'],
				'twitter'               => $twitter['informasi_value'],
				'instagram'             => $instagram['informasi_value'],
				'youtube'               => $youtube['informasi_value'],
				'jam_senin_kamis'       => $jam_senin_kamis['informasi_value'],
				'jam_jumat'             => $jam_jumat['informasi_value'],
				'jam_sabtu_minggu'      => $jam_sabtu_minggu['informasi_value'],
				'wa_akta'               => $wa_akta['informasi_value'],
				'wa_ktp'                => $wa_ktp['informasi_value'],
				'wa_pengaduan'          => $wa_pengaduan['informasi_value'],
				'jp_jenkel'             => $jp_jenkel['informasi_value'],
				'jp_wajib_ktp_jenkel'   => $jp_wajib_ktp_jenkel['informasi_value'],
				'jp_kepemilikan_kk'     => $jp_kepemilikan_kk['informasi_value'],
			];
			return view('halaman/single_galeri', $data);

		} else {
			return redirect()->to('/home/galeri');
		}
		
    }

	public function berita()
    {
		$this->visitor();
        $berita = 'tb_berita';
		$nomor_telepon          = $this->informasi->find(1);
		$email                  = $this->informasi->find(2);
		$alamat                 = $this->informasi->find(3);
		$facebook               = $this->informasi->find(4);
		$twitter                = $this->informasi->find(5);
		$instagram              = $this->informasi->find(6);
		$youtube                = $this->informasi->find(7);
		$jam_senin_kamis        = $this->informasi->find(8);
		$jam_jumat              = $this->informasi->find(9);
		$jam_sabtu_minggu       = $this->informasi->find(10);
		$wa_akta                = $this->informasi->find(11);
		$wa_ktp                 = $this->informasi->find(12);
		$wa_pengaduan           = $this->informasi->find(13);
		$jp_jenkel              = $this->informasi->find(14);
		$jp_wajib_ktp_jenkel    = $this->informasi->find(15);
		$jp_kepemilikan_kk      = $this->informasi->find(16);
		$data = [
			'layanan_kategori' 		=> $this->layanan_kategori->list(),
			'title'					=> 'Berita Dispendukcapil Kota Mojokerto',
			'berita'				=> $this->berita->where('berita_status', 'PUBLISH')->orderBy('berita_id', 'DESC')->paginate(9, $berita),
			'pager'		 			=> $this->berita->pager,
			'facebook'              => $facebook['informasi_value'],
			'twitter'               => $twitter['informasi_value'],
			'instagram'             => $instagram['informasi_value'],
			'youtube'               => $youtube['informasi_value'],
			'nomor_telepon'         => $nomor_telepon['informasi_value'],
			'email'                 => $email['informasi_value'],
			'alamat'                => $alamat['informasi_value'],
			'facebook'              => $facebook['informasi_value'],
			'twitter'               => $twitter['informasi_value'],
			'instagram'             => $instagram['informasi_value'],
			'youtube'               => $youtube['informasi_value'],
			'jam_senin_kamis'       => $jam_senin_kamis['informasi_value'],
			'jam_jumat'             => $jam_jumat['informasi_value'],
			'jam_sabtu_minggu'      => $jam_sabtu_minggu['informasi_value'],
			'wa_akta'               => $wa_akta['informasi_value'],
			'wa_ktp'                => $wa_ktp['informasi_value'],
			'wa_pengaduan'          => $wa_pengaduan['informasi_value'],
			'jp_jenkel'             => $jp_jenkel['informasi_value'],
			'jp_wajib_ktp_jenkel'   => $jp_wajib_ktp_jenkel['informasi_value'],
			'jp_kepemilikan_kk'     => $jp_kepemilikan_kk['informasi_value'],
		];
        return view('berita', $data);
    }

	public function single_berita($berita_slug)
    {
		$this->visitor();
		$cek 			= $this->berita->cek_single_berita($berita_slug);

		if ($cek == 1) {
			$berita 				= $this->berita->single_berita($berita_slug);
			$berita_judul			= $berita->berita_judul;
			$nomor_telepon          = $this->informasi->find(1);
			$email                  = $this->informasi->find(2);
			$alamat                 = $this->informasi->find(3);
			$facebook               = $this->informasi->find(4);
			$twitter                = $this->informasi->find(5);
			$instagram              = $this->informasi->find(6);
			$youtube                = $this->informasi->find(7);
			$jam_senin_kamis        = $this->informasi->find(8);
			$jam_jumat              = $this->informasi->find(9);
			$jam_sabtu_minggu       = $this->informasi->find(10);
			$wa_akta                = $this->informasi->find(11);
			$wa_ktp                 = $this->informasi->find(12);
			$wa_pengaduan           = $this->informasi->find(13);
			$jp_jenkel              = $this->informasi->find(14);
			$jp_wajib_ktp_jenkel    = $this->informasi->find(15);
			$jp_kepemilikan_kk      = $this->informasi->find(16);

			$data = [
				'layanan_kategori' 		=> $this->layanan_kategori->list(),
				'title'					=> 'Berita - ' . $berita_judul,
				'berita'				=> $berita,
				'nomor_telepon'         => $nomor_telepon['informasi_value'],
				'email'                 => $email['informasi_value'],
				'alamat'                => $alamat['informasi_value'],
				'facebook'              => $facebook['informasi_value'],
				'twitter'               => $twitter['informasi_value'],
				'instagram'             => $instagram['informasi_value'],
				'youtube'               => $youtube['informasi_value'],
				'jam_senin_kamis'       => $jam_senin_kamis['informasi_value'],
				'jam_jumat'             => $jam_jumat['informasi_value'],
				'jam_sabtu_minggu'      => $jam_sabtu_minggu['informasi_value'],
				'wa_akta'               => $wa_akta['informasi_value'],
				'wa_ktp'                => $wa_ktp['informasi_value'],
				'wa_pengaduan'          => $wa_pengaduan['informasi_value'],
				'jp_jenkel'             => $jp_jenkel['informasi_value'],
				'jp_wajib_ktp_jenkel'   => $jp_wajib_ktp_jenkel['informasi_value'],
				'jp_kepemilikan_kk'     => $jp_kepemilikan_kk['informasi_value'],
			];
			return view('halaman/single_berita', $data);
		} else {
			return redirect()->to('/home/berita');
		}
		
    }

	public function pengumuman()
    {
		$this->visitor();
        $pengumuman 			= 'tb_pengumuman';
		$nomor_telepon          = $this->informasi->find(1);
		$email                  = $this->informasi->find(2);
		$alamat                 = $this->informasi->find(3);
		$facebook               = $this->informasi->find(4);
		$twitter                = $this->informasi->find(5);
		$instagram              = $this->informasi->find(6);
		$youtube                = $this->informasi->find(7);
		$jam_senin_kamis        = $this->informasi->find(8);
		$jam_jumat              = $this->informasi->find(9);
		$jam_sabtu_minggu       = $this->informasi->find(10);
		$wa_akta                = $this->informasi->find(11);
		$wa_ktp                 = $this->informasi->find(12);
		$wa_pengaduan           = $this->informasi->find(13);
		$jp_jenkel              = $this->informasi->find(14);
		$jp_wajib_ktp_jenkel    = $this->informasi->find(15);
		$jp_kepemilikan_kk      = $this->informasi->find(16);

		$data = [
			'layanan_kategori' 		=> $this->layanan_kategori->list(),
			'title'					=> 'Pengumuman Dispendukcapil Kota Mojokerto',
			'pengumuman'			=> $this->pengumuman->where('pengumuman_status', 'PUBLISH')->orderBy('pengumuman_id', 'DESC')->paginate(9, $pengumuman),
			'pager'		 			=> $this->pengumuman->pager,
			'nomor_telepon'         => $nomor_telepon['informasi_value'],
			'email'                 => $email['informasi_value'],
			'alamat'                => $alamat['informasi_value'],
			'facebook'              => $facebook['informasi_value'],
			'twitter'               => $twitter['informasi_value'],
			'instagram'             => $instagram['informasi_value'],
			'youtube'               => $youtube['informasi_value'],
			'jam_senin_kamis'       => $jam_senin_kamis['informasi_value'],
			'jam_jumat'             => $jam_jumat['informasi_value'],
			'jam_sabtu_minggu'      => $jam_sabtu_minggu['informasi_value'],
			'wa_akta'               => $wa_akta['informasi_value'],
			'wa_ktp'                => $wa_ktp['informasi_value'],
			'wa_pengaduan'          => $wa_pengaduan['informasi_value'],
			'jp_jenkel'             => $jp_jenkel['informasi_value'],
			'jp_wajib_ktp_jenkel'   => $jp_wajib_ktp_jenkel['informasi_value'],
			'jp_kepemilikan_kk'     => $jp_kepemilikan_kk['informasi_value'],
		];
        return view('pengumuman', $data);
    }

	public function single_pengumuman($pengumuman_slug)
    {
		$this->visitor();
		$cek 						= $this->pengumuman->cek_single_pengumuman($pengumuman_slug);

		if ($cek == 1) {
			$pengumuman 			= $this->pengumuman->single_pengumuman($pengumuman_slug);
			$pengumuman_judul		= $pengumuman->pengumuman_judul;

			$nomor_telepon          = $this->informasi->find(1);
			$email                  = $this->informasi->find(2);
			$alamat                 = $this->informasi->find(3);
			$facebook               = $this->informasi->find(4);
			$twitter                = $this->informasi->find(5);
			$instagram              = $this->informasi->find(6);
			$youtube                = $this->informasi->find(7);
			$jam_senin_kamis        = $this->informasi->find(8);
			$jam_jumat              = $this->informasi->find(9);
			$jam_sabtu_minggu       = $this->informasi->find(10);
			$wa_akta                = $this->informasi->find(11);
			$wa_ktp                 = $this->informasi->find(12);
			$wa_pengaduan           = $this->informasi->find(13);
			$jp_jenkel              = $this->informasi->find(14);
			$jp_wajib_ktp_jenkel    = $this->informasi->find(15);
			$jp_kepemilikan_kk      = $this->informasi->find(16);

			$data = [
				'layanan_kategori' 		=> $this->layanan_kategori->list(),
				'title'					=> 'Pengumuman - ' . $pengumuman_judul,
				'pengumuman'			=> $pengumuman,
				'nomor_telepon'         => $nomor_telepon['informasi_value'],
				'email'                 => $email['informasi_value'],
				'alamat'                => $alamat['informasi_value'],
				'facebook'              => $facebook['informasi_value'],
				'twitter'               => $twitter['informasi_value'],
				'instagram'             => $instagram['informasi_value'],
				'youtube'               => $youtube['informasi_value'],
				'jam_senin_kamis'       => $jam_senin_kamis['informasi_value'],
				'jam_jumat'             => $jam_jumat['informasi_value'],
				'jam_sabtu_minggu'      => $jam_sabtu_minggu['informasi_value'],
				'wa_akta'               => $wa_akta['informasi_value'],
				'wa_ktp'                => $wa_ktp['informasi_value'],
				'wa_pengaduan'          => $wa_pengaduan['informasi_value'],
				'jp_jenkel'             => $jp_jenkel['informasi_value'],
				'jp_wajib_ktp_jenkel'   => $jp_wajib_ktp_jenkel['informasi_value'],
				'jp_kepemilikan_kk'     => $jp_kepemilikan_kk['informasi_value'],
			];
			return view('halaman/single_pengumuman', $data);
		} else {
			return redirect()->to('/home/pengumuman');
		}
		
    }

    public function profil_sambutan()
    {
		$this->visitor();
		$nomor_telepon          = $this->informasi->find(1);
		$email                  = $this->informasi->find(2);
		$alamat                 = $this->informasi->find(3);
		$facebook               = $this->informasi->find(4);
		$twitter                = $this->informasi->find(5);
		$instagram              = $this->informasi->find(6);
		$youtube                = $this->informasi->find(7);
		$jam_senin_kamis        = $this->informasi->find(8);
		$jam_jumat              = $this->informasi->find(9);
		$jam_sabtu_minggu       = $this->informasi->find(10);
		$wa_akta                = $this->informasi->find(11);
		$wa_ktp                 = $this->informasi->find(12);
		$wa_pengaduan           = $this->informasi->find(13);

		$sambutan_isi			= $this->profil->find(1);
		$sambutan_nama			= $this->profil->find(2);
		$sambutan_jabatan		= $this->profil->find(3);
		$sambutan_foto			= $this->profil->find(4);

		$data = [
			'layanan_kategori' 		=> $this->layanan_kategori->list(),
			'nomor_telepon'         => $nomor_telepon['informasi_value'],
			'email'                 => $email['informasi_value'],
			'alamat'                => $alamat['informasi_value'],
			'facebook'              => $facebook['informasi_value'],
			'twitter'               => $twitter['informasi_value'],
			'instagram'             => $instagram['informasi_value'],
			'youtube'               => $youtube['informasi_value'],
			'jam_senin_kamis'       => $jam_senin_kamis['informasi_value'],
			'jam_jumat'             => $jam_jumat['informasi_value'],
			'jam_sabtu_minggu'      => $jam_sabtu_minggu['informasi_value'],
			'wa_akta'               => $wa_akta['informasi_value'],
			'wa_ktp'                => $wa_ktp['informasi_value'],
			'wa_pengaduan'          => $wa_pengaduan['informasi_value'],
			'sambutan_isi'			=> $sambutan_isi['profil_value'],
			'sambutan_nama'			=> $sambutan_nama['profil_value'],
			'sambutan_jabatan'		=> $sambutan_jabatan['profil_value'],
			'sambutan_foto'			=> $sambutan_foto['profil_value'],
		];
        return view('halaman/profil_sambutan', $data);
    }

    public function profil_visimisi()
    {
		$this->visitor();
		$nomor_telepon          = $this->informasi->find(1);
		$email                  = $this->informasi->find(2);
		$alamat                 = $this->informasi->find(3);
		$facebook               = $this->informasi->find(4);
		$twitter                = $this->informasi->find(5);
		$instagram              = $this->informasi->find(6);
		$youtube                = $this->informasi->find(7);
		$jam_senin_kamis        = $this->informasi->find(8);
		$jam_jumat              = $this->informasi->find(9);
		$jam_sabtu_minggu       = $this->informasi->find(10);
		$wa_akta                = $this->informasi->find(11);
		$wa_ktp                 = $this->informasi->find(12);
		$wa_pengaduan           = $this->informasi->find(13);

		$visi					= $this->profil->find(5);
		$misi 					= $this->profil->find(6);

		$data = [
			'layanan_kategori' 		=> $this->layanan_kategori->list(),
			'nomor_telepon'         => $nomor_telepon['informasi_value'],
			'email'                 => $email['informasi_value'],
			'alamat'                => $alamat['informasi_value'],
			'facebook'              => $facebook['informasi_value'],
			'twitter'               => $twitter['informasi_value'],
			'instagram'             => $instagram['informasi_value'],
			'youtube'               => $youtube['informasi_value'],
			'jam_senin_kamis'       => $jam_senin_kamis['informasi_value'],
			'jam_jumat'             => $jam_jumat['informasi_value'],
			'jam_sabtu_minggu'      => $jam_sabtu_minggu['informasi_value'],
			'wa_akta'               => $wa_akta['informasi_value'],
			'wa_ktp'                => $wa_ktp['informasi_value'],
			'wa_pengaduan'          => $wa_pengaduan['informasi_value'],
			'visi'					=> $visi['profil_value'],
			'misi'					=> $misi['profil_value'],
		];
        return view('halaman/profil_visimisi', $data);
    }

    public function profil_strukturorganisasi()
    {
		$this->visitor();
		$nomor_telepon          = $this->informasi->find(1);
		$email                  = $this->informasi->find(2);
		$alamat                 = $this->informasi->find(3);
		$facebook               = $this->informasi->find(4);
		$twitter                = $this->informasi->find(5);
		$instagram              = $this->informasi->find(6);
		$youtube                = $this->informasi->find(7);
		$jam_senin_kamis        = $this->informasi->find(8);
		$jam_jumat              = $this->informasi->find(9);
		$jam_sabtu_minggu       = $this->informasi->find(10);
		$wa_akta                = $this->informasi->find(11);
		$wa_ktp                 = $this->informasi->find(12);
		$wa_pengaduan           = $this->informasi->find(13);

		$struktur_organisasi 	= $this->profil->find(7);

		$data = [
			'layanan_kategori' 		=> $this->layanan_kategori->list(),
			'nomor_telepon'         => $nomor_telepon['informasi_value'],
			'email'                 => $email['informasi_value'],
			'alamat'                => $alamat['informasi_value'],
			'facebook'              => $facebook['informasi_value'],
			'twitter'               => $twitter['informasi_value'],
			'instagram'             => $instagram['informasi_value'],
			'youtube'               => $youtube['informasi_value'],
			'jam_senin_kamis'       => $jam_senin_kamis['informasi_value'],
			'jam_jumat'             => $jam_jumat['informasi_value'],
			'jam_sabtu_minggu'      => $jam_sabtu_minggu['informasi_value'],
			'wa_akta'               => $wa_akta['informasi_value'],
			'wa_ktp'                => $wa_ktp['informasi_value'],
			'wa_pengaduan'          => $wa_pengaduan['informasi_value'],
			'struktur_organisasi'	=> $struktur_organisasi['profil_value'],
		];

        return view('halaman/profil_strukturorganisasi', $data);
    }

    public function profil_tupoksi()
    {
		$this->visitor();
		$nomor_telepon          = $this->informasi->find(1);
		$email                  = $this->informasi->find(2);
		$alamat                 = $this->informasi->find(3);
		$facebook               = $this->informasi->find(4);
		$twitter                = $this->informasi->find(5);
		$instagram              = $this->informasi->find(6);
		$youtube                = $this->informasi->find(7);
		$jam_senin_kamis        = $this->informasi->find(8);
		$jam_jumat              = $this->informasi->find(9);
		$jam_sabtu_minggu       = $this->informasi->find(10);
		$wa_akta                = $this->informasi->find(11);
		$wa_ktp                 = $this->informasi->find(12);
		$wa_pengaduan           = $this->informasi->find(13);

		$tupoksi_deskripsi 		= $this->profil->find(8);
		$tupoksi_pdf 			= $this->profil->find(9);

		$data = [
			'layanan_kategori' 		=> $this->layanan_kategori->list(),
			'nomor_telepon'         => $nomor_telepon['informasi_value'],
			'email'                 => $email['informasi_value'],
			'alamat'                => $alamat['informasi_value'],
			'facebook'              => $facebook['informasi_value'],
			'twitter'               => $twitter['informasi_value'],
			'instagram'             => $instagram['informasi_value'],
			'youtube'               => $youtube['informasi_value'],
			'jam_senin_kamis'       => $jam_senin_kamis['informasi_value'],
			'jam_jumat'             => $jam_jumat['informasi_value'],
			'jam_sabtu_minggu'      => $jam_sabtu_minggu['informasi_value'],
			'wa_akta'               => $wa_akta['informasi_value'],
			'wa_ktp'                => $wa_ktp['informasi_value'],
			'wa_pengaduan'          => $wa_pengaduan['informasi_value'],
			'tupoksi_deskripsi'		=> $tupoksi_deskripsi['profil_value'],
			'tupoksi_pdf'			=> $tupoksi_pdf['profil_value'],
		];
        return view('halaman/profil_tupoksi', $data);
    }

    public function profil_kebijakan_mutu()
    {
		$this->visitor();
		$nomor_telepon          = $this->informasi->find(1);
		$email                  = $this->informasi->find(2);
		$alamat                 = $this->informasi->find(3);
		$facebook               = $this->informasi->find(4);
		$twitter                = $this->informasi->find(5);
		$instagram              = $this->informasi->find(6);
		$youtube                = $this->informasi->find(7);
		$jam_senin_kamis        = $this->informasi->find(8);
		$jam_jumat              = $this->informasi->find(9);
		$jam_sabtu_minggu       = $this->informasi->find(10);
		$wa_akta                = $this->informasi->find(11);
		$wa_ktp                 = $this->informasi->find(12);
		$wa_pengaduan           = $this->informasi->find(13);

		$kualitas_deskripsi 	= $this->profil->find(10);
		$kualitas_pdf 			= $this->profil->find(11);

		$data = [
			'layanan_kategori' 		=> $this->layanan_kategori->list(),
			'nomor_telepon'         => $nomor_telepon['informasi_value'],
			'email'                 => $email['informasi_value'],
			'alamat'                => $alamat['informasi_value'],
			'facebook'              => $facebook['informasi_value'],
			'twitter'               => $twitter['informasi_value'],
			'instagram'             => $instagram['informasi_value'],
			'youtube'               => $youtube['informasi_value'],
			'jam_senin_kamis'       => $jam_senin_kamis['informasi_value'],
			'jam_jumat'             => $jam_jumat['informasi_value'],
			'jam_sabtu_minggu'      => $jam_sabtu_minggu['informasi_value'],
			'wa_akta'               => $wa_akta['informasi_value'],
			'wa_ktp'                => $wa_ktp['informasi_value'],
			'wa_pengaduan'          => $wa_pengaduan['informasi_value'],
			'kualitas_deskripsi'	=> $kualitas_deskripsi['profil_value'],
			'kualitas_pdf'			=> $kualitas_pdf['profil_value'],
		];
        return view('halaman/profil_kebijakan_mutu', $data);
    }

    public function inovasi_layanan()
    {
		$this->visitor();
		$nomor_telepon          = $this->informasi->find(1);
		$email                  = $this->informasi->find(2);
		$alamat                 = $this->informasi->find(3);
		$facebook               = $this->informasi->find(4);
		$twitter                = $this->informasi->find(5);
		$instagram              = $this->informasi->find(6);
		$youtube                = $this->informasi->find(7);
		$jam_senin_kamis        = $this->informasi->find(8);
		$jam_jumat              = $this->informasi->find(9);
		$jam_sabtu_minggu       = $this->informasi->find(10);
		$wa_akta                = $this->informasi->find(11);
		$wa_ktp                 = $this->informasi->find(12);
		$wa_pengaduan           = $this->informasi->find(13);

		$data = [
			'layanan_kategori' 		=> $this->layanan_kategori->list(),
			'nomor_telepon'         => $nomor_telepon['informasi_value'],
			'email'                 => $email['informasi_value'],
			'alamat'                => $alamat['informasi_value'],
			'facebook'              => $facebook['informasi_value'],
			'twitter'               => $twitter['informasi_value'],
			'instagram'             => $instagram['informasi_value'],
			'youtube'               => $youtube['informasi_value'],
			'jam_senin_kamis'       => $jam_senin_kamis['informasi_value'],
			'jam_jumat'             => $jam_jumat['informasi_value'],
			'jam_sabtu_minggu'      => $jam_sabtu_minggu['informasi_value'],
			'wa_akta'               => $wa_akta['informasi_value'],
			'wa_ktp'                => $wa_ktp['informasi_value'],
			'wa_pengaduan'          => $wa_pengaduan['informasi_value'],
			'inovasi'				=> $this->inovasi->list(),
		];
        return view('halaman/inovasi_layanan', $data);
    }

    public function layanan_kategori($LK_slug)
    {
		$this->visitor();
		$cek 					= $this->layanan_kategori->cek_layanan_kategori($LK_slug);

		if ($cek == 1) {
			$LK 					= $this->layanan_kategori->single_layanan_kategori($LK_slug);
			$LK_id					= $LK->LK_id;
			$layanan				= $this->layanan->list_layanan_kategori($LK_id);
			$nomor_telepon          = $this->informasi->find(1);
			$email                  = $this->informasi->find(2);
			$alamat                 = $this->informasi->find(3);
			$facebook               = $this->informasi->find(4);
			$twitter                = $this->informasi->find(5);
			$instagram              = $this->informasi->find(6);
			$youtube                = $this->informasi->find(7);
			$jam_senin_kamis        = $this->informasi->find(8);
			$jam_jumat              = $this->informasi->find(9);
			$jam_sabtu_minggu       = $this->informasi->find(10);
			$wa_akta                = $this->informasi->find(11);
			$wa_ktp                 = $this->informasi->find(12);
			$wa_pengaduan           = $this->informasi->find(13);

			$data = [
				'layanan_kategori' 		=> $this->layanan_kategori->list(),
				'LK_nama'				=> $LK->LK_nama,
				'LK_id' 				=> $LK_id,
				'layanan'				=> $layanan,
				'nomor_telepon'         => $nomor_telepon['informasi_value'],
				'email'                 => $email['informasi_value'],
				'alamat'                => $alamat['informasi_value'],
				'facebook'              => $facebook['informasi_value'],
				'twitter'               => $twitter['informasi_value'],
				'instagram'             => $instagram['informasi_value'],
				'youtube'               => $youtube['informasi_value'],
				'jam_senin_kamis'       => $jam_senin_kamis['informasi_value'],
				'jam_jumat'             => $jam_jumat['informasi_value'],
				'jam_sabtu_minggu'      => $jam_sabtu_minggu['informasi_value'],
				'wa_akta'               => $wa_akta['informasi_value'],
				'wa_ktp'                => $wa_ktp['informasi_value'],
				'wa_pengaduan'          => $wa_pengaduan['informasi_value'],
			];

			return view('layanan', $data);
		} else {
			return redirect()->to('/home');
		}
		
    }

	public function layanan($layanan_slug)
    {
		$this->visitor();
		$layanan_data				= $this->layanan->layanan_data($layanan_slug);

		$cek 						= $this->layanan->cek_layanan($layanan_slug);

		if ($cek == '1') {
			$layanan_kategori			= $layanan_data->layanan_kategori;
			$LK						= $this->layanan_kategori->find($layanan_kategori);
			$nomor_telepon          = $this->informasi->find(1);
			$email                  = $this->informasi->find(2);
			$alamat                 = $this->informasi->find(3);
			$facebook               = $this->informasi->find(4);
			$twitter                = $this->informasi->find(5);
			$instagram              = $this->informasi->find(6);
			$youtube                = $this->informasi->find(7);
			$jam_senin_kamis        = $this->informasi->find(8);
			$jam_jumat              = $this->informasi->find(9);
			$jam_sabtu_minggu       = $this->informasi->find(10);
			$wa_akta                = $this->informasi->find(11);
			$wa_ktp                 = $this->informasi->find(12);
			$wa_pengaduan           = $this->informasi->find(13);

			$data = [
				'layanan_kategori' 		=> $this->layanan_kategori->list(),
				'LK_slug'				=> $LK['LK_slug'],
				'LK_nama'				=> $LK['LK_nama'],
				'layanan'				=> $layanan_data,
				'nomor_telepon'         => $nomor_telepon['informasi_value'],
				'email'                 => $email['informasi_value'],
				'alamat'                => $alamat['informasi_value'],
				'facebook'              => $facebook['informasi_value'],
				'twitter'               => $twitter['informasi_value'],
				'instagram'             => $instagram['informasi_value'],
				'youtube'               => $youtube['informasi_value'],
				'jam_senin_kamis'       => $jam_senin_kamis['informasi_value'],
				'jam_jumat'             => $jam_jumat['informasi_value'],
				'jam_sabtu_minggu'      => $jam_sabtu_minggu['informasi_value'],
				'wa_akta'               => $wa_akta['informasi_value'],
				'wa_ktp'                => $wa_ktp['informasi_value'],
				'wa_pengaduan'          => $wa_pengaduan['informasi_value'],
			];

			return view('halaman/single_layanan', $data);
		} else {
			return redirect()->to('/home');
		}
		
    }

	public function alur_adu()
    {
		$this->visitor();
		$data_medfo				= $this->medfo->alur_adu();
		
		$alur_adu				= $data_medfo->medfo_isi;
		$nomor_telepon          = $this->informasi->find(1);
		$email                  = $this->informasi->find(2);
		$alamat                 = $this->informasi->find(3);
		$facebook               = $this->informasi->find(4);
		$twitter                = $this->informasi->find(5);
		$instagram              = $this->informasi->find(6);
		$youtube                = $this->informasi->find(7);
		$jam_senin_kamis        = $this->informasi->find(8);
		$jam_jumat              = $this->informasi->find(9);
		$jam_sabtu_minggu       = $this->informasi->find(10);
		$wa_akta                = $this->informasi->find(11);
		$wa_ktp                 = $this->informasi->find(12);
		$wa_pengaduan           = $this->informasi->find(13);

		$data = [
			'layanan_kategori' 		=> $this->layanan_kategori->list(),
			'alur_adu'				=> $alur_adu,
			'nomor_telepon'         => $nomor_telepon['informasi_value'],
			'email'                 => $email['informasi_value'],
			'alamat'                => $alamat['informasi_value'],
			'facebook'              => $facebook['informasi_value'],
			'twitter'               => $twitter['informasi_value'],
			'instagram'             => $instagram['informasi_value'],
			'youtube'               => $youtube['informasi_value'],
			'jam_senin_kamis'       => $jam_senin_kamis['informasi_value'],
			'jam_jumat'             => $jam_jumat['informasi_value'],
			'jam_sabtu_minggu'      => $jam_sabtu_minggu['informasi_value'],
			'wa_akta'               => $wa_akta['informasi_value'],
			'wa_ktp'                => $wa_ktp['informasi_value'],
			'wa_pengaduan'          => $wa_pengaduan['informasi_value'],
		];
        return view('halaman/alur_adu', $data);
    }

	public function ikm()
    {
		$this->visitor();
		$data_medfo				= $this->medfo->ikm();
		
		$ikm					= $data_medfo->medfo_isi;
		$nomor_telepon          = $this->informasi->find(1);
		$email                  = $this->informasi->find(2);
		$alamat                 = $this->informasi->find(3);
		$facebook               = $this->informasi->find(4);
		$twitter                = $this->informasi->find(5);
		$instagram              = $this->informasi->find(6);
		$youtube                = $this->informasi->find(7);
		$jam_senin_kamis        = $this->informasi->find(8);
		$jam_jumat              = $this->informasi->find(9);
		$jam_sabtu_minggu       = $this->informasi->find(10);
		$wa_akta                = $this->informasi->find(11);
		$wa_ktp                 = $this->informasi->find(12);
		$wa_pengaduan           = $this->informasi->find(13);

		$data = [
			'layanan_kategori' 		=> $this->layanan_kategori->list(),
			'ikm'					=> $ikm,
			'nomor_telepon'         => $nomor_telepon['informasi_value'],
			'email'                 => $email['informasi_value'],
			'alamat'                => $alamat['informasi_value'],
			'facebook'              => $facebook['informasi_value'],
			'twitter'               => $twitter['informasi_value'],
			'instagram'             => $instagram['informasi_value'],
			'youtube'               => $youtube['informasi_value'],
			'jam_senin_kamis'       => $jam_senin_kamis['informasi_value'],
			'jam_jumat'             => $jam_jumat['informasi_value'],
			'jam_sabtu_minggu'      => $jam_sabtu_minggu['informasi_value'],
			'wa_akta'               => $wa_akta['informasi_value'],
			'wa_ktp'                => $wa_ktp['informasi_value'],
			'wa_pengaduan'          => $wa_pengaduan['informasi_value'],
		];
        return view('halaman/ikm', $data);
    }

	public function hubungi_kami()
    {
		$this->visitor();
		$nomor_telepon          = $this->informasi->find(1);
		$email                  = $this->informasi->find(2);
		$alamat                 = $this->informasi->find(3);
		$facebook               = $this->informasi->find(4);
		$twitter                = $this->informasi->find(5);
		$instagram              = $this->informasi->find(6);
		$youtube                = $this->informasi->find(7);
		$jam_senin_kamis        = $this->informasi->find(8);
		$jam_jumat              = $this->informasi->find(9);
		$jam_sabtu_minggu       = $this->informasi->find(10);
		$wa_akta                = $this->informasi->find(11);
		$wa_ktp                 = $this->informasi->find(12);
		$wa_pengaduan           = $this->informasi->find(13);

		$data = [
			'layanan_kategori' 		=> $this->layanan_kategori->list(),
			'nomor_telepon'         => $nomor_telepon['informasi_value'],
			'email'                 => $email['informasi_value'],
			'alamat'                => $alamat['informasi_value'],
			'facebook'              => $facebook['informasi_value'],
			'twitter'               => $twitter['informasi_value'],
			'instagram'             => $instagram['informasi_value'],
			'youtube'               => $youtube['informasi_value'],
			'jam_senin_kamis'       => $jam_senin_kamis['informasi_value'],
			'jam_jumat'             => $jam_jumat['informasi_value'],
			'jam_sabtu_minggu'      => $jam_sabtu_minggu['informasi_value'],
			'wa_akta'               => $wa_akta['informasi_value'],
			'wa_ktp'                => $wa_ktp['informasi_value'],
			'wa_pengaduan'          => $wa_pengaduan['informasi_value'],
		];
        return view('halaman/hubungi_kami', $data);
    }
	
	public function penghargaan()
    {
		$this->visitor();
        $penghargaan 			= 'tb_penghargaan';
		$nomor_telepon          = $this->informasi->find(1);
		$email                  = $this->informasi->find(2);
		$alamat                 = $this->informasi->find(3);
		$facebook               = $this->informasi->find(4);
		$twitter                = $this->informasi->find(5);
		$instagram              = $this->informasi->find(6);
		$youtube                = $this->informasi->find(7);
		$jam_senin_kamis        = $this->informasi->find(8);
		$jam_jumat              = $this->informasi->find(9);
		$jam_sabtu_minggu       = $this->informasi->find(10);
		$wa_akta                = $this->informasi->find(11);
		$wa_ktp                 = $this->informasi->find(12);
		$wa_pengaduan           = $this->informasi->find(13);
		$jp_jenkel              = $this->informasi->find(14);
		$jp_wajib_ktp_jenkel    = $this->informasi->find(15);
		$jp_kepemilikan_kk      = $this->informasi->find(16);
		$data = [
			'layanan_kategori' 		=> $this->layanan_kategori->list(),
			'title'					=> 'Penghargaan Dispendukcapil Kota Mojokerto',
			'penghargaan'			=> $this->penghargaan->orderBy('penghargaan_id', 'DESC')->paginate(9, $penghargaan),
			'pager'		 			=> $this->penghargaan->pager,
			'facebook'              => $facebook['informasi_value'],
			'twitter'               => $twitter['informasi_value'],
			'instagram'             => $instagram['informasi_value'],
			'youtube'               => $youtube['informasi_value'],
			'nomor_telepon'         => $nomor_telepon['informasi_value'],
			'email'                 => $email['informasi_value'],
			'alamat'                => $alamat['informasi_value'],
			'facebook'              => $facebook['informasi_value'],
			'twitter'               => $twitter['informasi_value'],
			'instagram'             => $instagram['informasi_value'],
			'youtube'               => $youtube['informasi_value'],
			'jam_senin_kamis'       => $jam_senin_kamis['informasi_value'],
			'jam_jumat'             => $jam_jumat['informasi_value'],
			'jam_sabtu_minggu'      => $jam_sabtu_minggu['informasi_value'],
			'wa_akta'               => $wa_akta['informasi_value'],
			'wa_ktp'                => $wa_ktp['informasi_value'],
			'wa_pengaduan'          => $wa_pengaduan['informasi_value'],
			'jp_jenkel'             => $jp_jenkel['informasi_value'],
			'jp_wajib_ktp_jenkel'   => $jp_wajib_ktp_jenkel['informasi_value'],
			'jp_kepemilikan_kk'     => $jp_kepemilikan_kk['informasi_value'],
		];
        return view('penghargaan', $data);
    }

	public function single_penghargaan($penghargaan_slug)
    {
		$this->visitor();
		$cek 						= $this->penghargaan->cek_single_penghargaan($penghargaan_slug);

		if ($cek == 1) {
			$penghargaan 			= $this->penghargaan->single_penghargaan($penghargaan_slug);
			$penghargaan_nama		= $penghargaan->penghargaan_nama;
			$nomor_telepon          = $this->informasi->find(1);
			$email                  = $this->informasi->find(2);
			$alamat                 = $this->informasi->find(3);
			$facebook               = $this->informasi->find(4);
			$twitter                = $this->informasi->find(5);
			$instagram              = $this->informasi->find(6);
			$youtube                = $this->informasi->find(7);
			$jam_senin_kamis        = $this->informasi->find(8);
			$jam_jumat              = $this->informasi->find(9);
			$jam_sabtu_minggu       = $this->informasi->find(10);
			$wa_akta                = $this->informasi->find(11);
			$wa_ktp                 = $this->informasi->find(12);
			$wa_pengaduan           = $this->informasi->find(13);
			$jp_jenkel              = $this->informasi->find(14);
			$jp_wajib_ktp_jenkel    = $this->informasi->find(15);
			$jp_kepemilikan_kk      = $this->informasi->find(16);

			$data = [
				'layanan_kategori' 		=> $this->layanan_kategori->list(),
				'title'					=> 'Penghargaan - ' . $penghargaan_nama,
				'penghargaan'			=> $penghargaan,
				'nomor_telepon'         => $nomor_telepon['informasi_value'],
				'email'                 => $email['informasi_value'],
				'alamat'                => $alamat['informasi_value'],
				'facebook'              => $facebook['informasi_value'],
				'twitter'               => $twitter['informasi_value'],
				'instagram'             => $instagram['informasi_value'],
				'youtube'               => $youtube['informasi_value'],
				'jam_senin_kamis'       => $jam_senin_kamis['informasi_value'],
				'jam_jumat'             => $jam_jumat['informasi_value'],
				'jam_sabtu_minggu'      => $jam_sabtu_minggu['informasi_value'],
				'wa_akta'               => $wa_akta['informasi_value'],
				'wa_ktp'                => $wa_ktp['informasi_value'],
				'wa_pengaduan'          => $wa_pengaduan['informasi_value'],
				'jp_jenkel'             => $jp_jenkel['informasi_value'],
				'jp_wajib_ktp_jenkel'   => $jp_wajib_ktp_jenkel['informasi_value'],
				'jp_kepemilikan_kk'     => $jp_kepemilikan_kk['informasi_value'],
			];
			return view('halaman/single_penghargaan', $data);
		} else {
			return redirect()->to('/home/penghargaan');
		}
		
    }

	public function zona_integritas()
    {
		$this->visitor();
		$nomor_telepon          = $this->informasi->find(1);
		$email                  = $this->informasi->find(2);
		$alamat                 = $this->informasi->find(3);
		$facebook               = $this->informasi->find(4);
		$twitter                = $this->informasi->find(5);
		$instagram              = $this->informasi->find(6);
		$youtube                = $this->informasi->find(7);
		$jam_senin_kamis        = $this->informasi->find(8);
		$jam_jumat              = $this->informasi->find(9);
		$jam_sabtu_minggu       = $this->informasi->find(10);
		$wa_akta                = $this->informasi->find(11);
		$wa_ktp                 = $this->informasi->find(12);
		$wa_pengaduan           = $this->informasi->find(13);

		$zi_deskripsi 			= $this->profil->find(12);

		$data = [
			'layanan_kategori' 		=> $this->layanan_kategori->list(),
			'nomor_telepon'         => $nomor_telepon['informasi_value'],
			'email'                 => $email['informasi_value'],
			'alamat'                => $alamat['informasi_value'],
			'facebook'              => $facebook['informasi_value'],
			'twitter'               => $twitter['informasi_value'],
			'instagram'             => $instagram['informasi_value'],
			'youtube'               => $youtube['informasi_value'],
			'jam_senin_kamis'       => $jam_senin_kamis['informasi_value'],
			'jam_jumat'             => $jam_jumat['informasi_value'],
			'jam_sabtu_minggu'      => $jam_sabtu_minggu['informasi_value'],
			'wa_akta'               => $wa_akta['informasi_value'],
			'wa_ktp'                => $wa_ktp['informasi_value'],
			'wa_pengaduan'          => $wa_pengaduan['informasi_value'],
			'zi_deskripsi'			=> $zi_deskripsi['profil_value'],
			'zi_file'				=> $this->zi->list(),
		];
        return view('halaman/zona_integritas', $data);
    }

	public function gisa_kategori()
    {
		$this->visitor();

			$nomor_telepon          = $this->informasi->find(1);
			$email                  = $this->informasi->find(2);
			$alamat                 = $this->informasi->find(3);
			$facebook               = $this->informasi->find(4);
			$twitter                = $this->informasi->find(5);
			$instagram              = $this->informasi->find(6);
			$youtube                = $this->informasi->find(7);
			$jam_senin_kamis        = $this->informasi->find(8);
			$jam_jumat              = $this->informasi->find(9);
			$jam_sabtu_minggu       = $this->informasi->find(10);
			$wa_akta                = $this->informasi->find(11);
			$wa_ktp                 = $this->informasi->find(12);
			$wa_pengaduan           = $this->informasi->find(13);

			$data = [
				'layanan_kategori' 		=> $this->layanan_kategori->list(),
				'gisa_kategori' 		=> $this->gisa_kategori->list(),
				'nomor_telepon'         => $nomor_telepon['informasi_value'],
				'email'                 => $email['informasi_value'],
				'alamat'                => $alamat['informasi_value'],
				'facebook'              => $facebook['informasi_value'],
				'twitter'               => $twitter['informasi_value'],
				'instagram'             => $instagram['informasi_value'],
				'youtube'               => $youtube['informasi_value'],
				'jam_senin_kamis'       => $jam_senin_kamis['informasi_value'],
				'jam_jumat'             => $jam_jumat['informasi_value'],
				'jam_sabtu_minggu'      => $jam_sabtu_minggu['informasi_value'],
				'wa_akta'               => $wa_akta['informasi_value'],
				'wa_ktp'                => $wa_ktp['informasi_value'],
				'wa_pengaduan'          => $wa_pengaduan['informasi_value'],
			];

			return view('gisa_kategori', $data);
    }

	public function gisa_subkategori($GK_slug)
    {
		$this->visitor();
		$gisa_kategori_id			= $this->gisa_kategori->gisa_kategori_id($GK_slug);
		$cek 						= $this->gisa_kategori->cek_gisa_kategori($GK_slug);
		if ($cek != NULL) {
			$GK_id 					= $gisa_kategori_id->GK_id;
			$list 					= $this->gisa_subkategori->list_GK_id($GK_id);
			$GK						= $this->gisa_kategori->find($GK_id);
			$nomor_telepon          = $this->informasi->find(1);
			$email                  = $this->informasi->find(2);
			$alamat                 = $this->informasi->find(3);
			$facebook               = $this->informasi->find(4);
			$twitter                = $this->informasi->find(5);
			$instagram              = $this->informasi->find(6);
			$youtube                = $this->informasi->find(7);
			$jam_senin_kamis        = $this->informasi->find(8);
			$jam_jumat              = $this->informasi->find(9);
			$jam_sabtu_minggu       = $this->informasi->find(10);
			$wa_akta                = $this->informasi->find(11);
			$wa_ktp                 = $this->informasi->find(12);
			$wa_pengaduan           = $this->informasi->find(13);

			$data = [
				'layanan_kategori' 		=> $this->layanan_kategori->list(),
				'GK_slug'				=> $GK['GK_slug'],
				'GK_nama'				=> $GK['GK_nama'],
				'gisa'					=> $list,
				'nomor_telepon'         => $nomor_telepon['informasi_value'],
				'email'                 => $email['informasi_value'],
				'alamat'                => $alamat['informasi_value'],
				'facebook'              => $facebook['informasi_value'],
				'twitter'               => $twitter['informasi_value'],
				'instagram'             => $instagram['informasi_value'],
				'youtube'               => $youtube['informasi_value'],
				'jam_senin_kamis'       => $jam_senin_kamis['informasi_value'],
				'jam_jumat'             => $jam_jumat['informasi_value'],
				'jam_sabtu_minggu'      => $jam_sabtu_minggu['informasi_value'],
				'wa_akta'               => $wa_akta['informasi_value'],
				'wa_ktp'                => $wa_ktp['informasi_value'],
				'wa_pengaduan'          => $wa_pengaduan['informasi_value'],
			];

			return view('gisa_subkategori', $data);
		} else {
			return redirect()->to('/home');
		}
    }

	public function gisa_sub_sub_kategori()
    {
		$this->visitor();
		$uri                	= service('uri');
        $GK_slug   				= $uri->getSegment(3);
		$GKS_slug   			= $uri->getSegment(4);
		
        if ($GK_slug == NULL || $GKS_slug == NULL) {
            return redirect()->to('/home');
        } elseif ($GK_slug != NULL && $GKS_slug != NULL) {
			$cek_slug_kategori          = $this->gisa_kategori->cek_gisa_kategori($GK_slug);
			$cek_slug_subkategori 		= $this->gisa_subkategori->cek_gisa_subkategori($GKS_slug);

			if ($cek_slug_kategori != 0 && $cek_slug_subkategori != 0) {
				$gisa_kategori_id			= $this->gisa_kategori->gisa_kategori_id($GK_slug);
				$GK_id 						= $gisa_kategori_id->GK_id;

				$gisa_subkategori_id		= $this->gisa_subkategori->gisa_kategori_id($GKS_slug);
				$GKS_id 					= $gisa_subkategori_id->GKS_id;

				$list 						= $this->gisa->list_GK_GKS($GK_id, $GKS_id);

					$GK						= $this->gisa_kategori->find($GK_id);
					$GKS					= $this->gisa_subkategori->find($GKS_id);
					$nomor_telepon          = $this->informasi->find(1);
					$email                  = $this->informasi->find(2);
					$alamat                 = $this->informasi->find(3);
					$facebook               = $this->informasi->find(4);
					$twitter                = $this->informasi->find(5);
					$instagram              = $this->informasi->find(6);
					$youtube                = $this->informasi->find(7);
					$jam_senin_kamis        = $this->informasi->find(8);
					$jam_jumat              = $this->informasi->find(9);
					$jam_sabtu_minggu       = $this->informasi->find(10);
					$wa_akta                = $this->informasi->find(11);
					$wa_ktp                 = $this->informasi->find(12);
					$wa_pengaduan           = $this->informasi->find(13);

					$data = [
						'layanan_kategori' 		=> $this->layanan_kategori->list(),
						'GK_slug'				=> $GK['GK_slug'],
						'GK_nama'				=> $GK['GK_nama'],
						'GKS_slug'				=> $GKS['GKS_slug'],
						'GKS_nama'				=> $GKS['GKS_nama'],
						'gisa'					=> $list,
						'nomor_telepon'         => $nomor_telepon['informasi_value'],
						'email'                 => $email['informasi_value'],
						'alamat'                => $alamat['informasi_value'],
						'facebook'              => $facebook['informasi_value'],
						'twitter'               => $twitter['informasi_value'],
						'instagram'             => $instagram['informasi_value'],
						'youtube'               => $youtube['informasi_value'],
						'jam_senin_kamis'       => $jam_senin_kamis['informasi_value'],
						'jam_jumat'             => $jam_jumat['informasi_value'],
						'jam_sabtu_minggu'      => $jam_sabtu_minggu['informasi_value'],
						'wa_akta'               => $wa_akta['informasi_value'],
						'wa_ktp'                => $wa_ktp['informasi_value'],
						'wa_pengaduan'          => $wa_pengaduan['informasi_value'],
					];

					return view('gisa_sub_subkategori', $data);
			} else {
				return redirect()->to('/home');
			}
        }
		
    }

	

	public function gisa()
    {
		$this->visitor();
		$uri                		= service('uri');
        $GK_slug   					= $uri->getSegment(3);
		$GKS_slug   				= $uri->getSegment(4);
		$gisa_slug   				= $uri->getSegment(5);


		if ($GK_slug == NULL || $GKS_slug == NULL || $gisa_slug == NULL) {
			return redirect()->to('/home');
		} elseif ($GK_slug != NULL && $GKS_slug != NULL && $gisa_slug != NULL) {

			$cek_slug_kategori          = $this->gisa_kategori->cek_gisa_kategori($GK_slug);
			$cek_slug_subkategori 		= $this->gisa_subkategori->cek_gisa_subkategori($GKS_slug);
			$cek_slug_gisa 				= $this->gisa->cek2_gisa($gisa_slug);

			if ($cek_slug_kategori != 0 && $cek_slug_subkategori != 0 && $cek_slug_gisa != 0) {
				$gisa_kategori_id			= $this->gisa_kategori->gisa_kategori_id($GK_slug);
				$GK_id 						= $gisa_kategori_id->GK_id;

				$gisa_subkategori_id		= $this->gisa_subkategori->gisa_kategori_id($GKS_slug);
				$GKS_id 					= $gisa_subkategori_id->GKS_id;
				$gisa_data					= $this->gisa->gisa_data($GK_id, $GKS_id, $gisa_slug);
				$gisa_kategori 				= $gisa_data->gisa_kategori;

				$GK						= $this->gisa_kategori->find($GK_id);
				$GKS					= $this->gisa_subkategori->find($GKS_id);
				$nomor_telepon          = $this->informasi->find(1);
				$email                  = $this->informasi->find(2);
				$alamat                 = $this->informasi->find(3);
				$facebook               = $this->informasi->find(4);
				$twitter                = $this->informasi->find(5);
				$instagram              = $this->informasi->find(6);
				$youtube                = $this->informasi->find(7);
				$jam_senin_kamis        = $this->informasi->find(8);
				$jam_jumat              = $this->informasi->find(9);
				$jam_sabtu_minggu       = $this->informasi->find(10);
				$wa_akta                = $this->informasi->find(11);
				$wa_ktp                 = $this->informasi->find(12);
				$wa_pengaduan           = $this->informasi->find(13);

				$data = [
					'layanan_kategori' 		=> $this->layanan_kategori->list(),
					'GK_slug'				=> $GK['GK_slug'],
					'GK_nama'				=> $GK['GK_nama'],
					'GKS_slug'				=> $GKS['GKS_slug'],
					'GKS_nama'				=> $GKS['GKS_nama'],
					'gisa'					=> $gisa_data,
					'nomor_telepon'         => $nomor_telepon['informasi_value'],
					'email'                 => $email['informasi_value'],
					'alamat'                => $alamat['informasi_value'],
					'facebook'              => $facebook['informasi_value'],
					'twitter'               => $twitter['informasi_value'],
					'instagram'             => $instagram['informasi_value'],
					'youtube'               => $youtube['informasi_value'],
					'jam_senin_kamis'       => $jam_senin_kamis['informasi_value'],
					'jam_jumat'             => $jam_jumat['informasi_value'],
					'jam_sabtu_minggu'      => $jam_sabtu_minggu['informasi_value'],
					'wa_akta'               => $wa_akta['informasi_value'],
					'wa_ktp'                => $wa_ktp['informasi_value'],
					'wa_pengaduan'          => $wa_pengaduan['informasi_value'],
				];

				return view('halaman/single_gisa', $data);
			} else {
				return redirect()->to('/home');
			}
			
			
				
		}
	
    }
}
