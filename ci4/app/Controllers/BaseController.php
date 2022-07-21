<?php

namespace App\Controllers;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 *
 * @package CodeIgniter
 */

use CodeIgniter\Controller;

// use App\Models\Modelfoto;
// use App\Models\Modelgallery;
// use App\Models\Modelstaf;
// use App\Models\Modelmapel;
// use App\Models\Modelguru;
// use App\Models\Modelkategori;
// use App\Models\Modelsiswa;
// use App\Models\Modelkelas;
// use App\Models\Modelkelulusan;
// use App\Models\Modelkonfigurasi;

// use App\Models\Modelspp;
use App\Models\Modeluser;

use App\Models\Model_Galeri;
use App\Models\Model_Galeri_Foto;
use App\Models\Model_Berita;
use App\Models\Model_Pengumuman;
use App\Models\Model_Link;
use App\Models\Model_Informasi;
use App\Models\Model_Profil;
use App\Models\Model_Inovasi;
use App\Models\Model_Layanan;
use App\Models\Model_Layanan_Kategori;
use App\Models\Model_Medfo;
use App\Models\Model_Penghargaan;
use App\Models\Model_Log;

class BaseController extends Controller
{

	/**
	 * An array of helpers to be loaded automatically upon
	 * class instantiation. These helpers will be available
	 * to all other controllers that extend BaseController.
	 *
	 * @var array
	 */
	protected $helpers = ['form', 'url', 'Tgl_indo'];

	/**
	 * Constructor.
	 */
	public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
	{
		// Do Not Edit This Line
		parent::initController($request, $response, $logger);

		//--------------------------------------------------------------------
		// Preload any models, libraries, etc, here.
		//--------------------------------------------------------------------
		// E.g.:
		$this->session = \Config\Services::session();
		// $this->staf = new Modelstaf;
		// $this->mapel = new Modelmapel;
		// $this->guru = new Modelguru;
		// $this->siswa = new Modelsiswa($request);
		// $this->kelas = new Modelkelas;
		// $this->spp = new Modelspp($request);
		// $this->kategori = new Modelkategori;
		
		// $this->gallery = new Modelgallery;
		// $this->foto = new Modelfoto;
		
		// $this->kelulusan = new Modelkelulusan($request);
		// $this->konfigurasi = new Modelkonfigurasi;
		// $this->user = new Modeluser;

		$this->galeri			= new Model_Galeri;
		$this->galeri_foto		= new Model_Galeri_Foto;
		$this->berita 			= new Model_Berita;
		$this->pengumuman 		= new Model_Pengumuman;
		$this->link 			= new Model_Link;
		$this->informasi 		= new Model_Informasi;
		$this->profil 			= new Model_Profil;
		$this->inovasi 			= new Model_Inovasi;
		$this->layanan 			= new Model_Layanan;
		$this->layanan_kategori = new Model_Layanan_Kategori;
		$this->medfo 			= new Model_Medfo;
		$this->penghargaan 		= new Model_Penghargaan;		
		$this->log 				= new Model_Log;
	}
}
