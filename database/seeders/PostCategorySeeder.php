<?php

namespace Database\Seeders;

use App\Models\PostCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        collect([
            [
                'name' => 'Juragan News',
                'description' => 'Kategori Juragan News berisi berita-berita terkini mengenai berbagai topik, seperti politik, ekonomi, teknologi, dan hiburan. Anda dapat membaca artikel-artikel menarik dan terpercaya dari penulis ahli di bidangnya.'
            ],
            [
                'name' => 'Juragan Wiki',
                'description' => 'Kategori Juragan Wiki berisi informasi-informasi menarik dan berguna mengenai berbagai topik, seperti sejarah, geografi, biografi, dan lain-lain. Anda dapat belajar banyak hal baru dan menambah wawasan dengan membaca artikel-artikel di kategori ini.'
            ],
            [
                'name' => 'Juragan Edu',
                'description' => 'Kategori Juragan Edu berisi materi-materi edukatif yang dapat membantu Anda belajar dan meningkatkan keterampilan, seperti tutorial, kursus, dan tips-trik. Anda dapat belajar secara mandiri atau mengikuti program-program pendidikan yang disediakan oleh mitra-mitra kami.'
            ],
            [
                'name' => 'Juragan Event',
                'description' => 'Kategori Juragan Event berisi informasi-informasi mengenai acara-acara yang akan datang, seperti seminar, konferensi, konser, dan festival. Anda dapat mencari acara yang ingin Anda hadiri dan mendaftar melalui platform kami.'
            ],
            [
                'name' => 'Juragan Inspire',
                'description' => 'Kategori Juragan Inspire berisi kisah-kisah inspiratif dan motivatif dari orang-orang yang berhasil meraih sukses atau melewati masa-masa sulit dalam hidup mereka. Anda dapat membaca kisah-kisah ini untuk memperoleh motivasi dan inspirasi dalam menghadapi tantangan hidup.'
            ],
        ])->each(function ($items) {
            DB::table("post_categories")->insert($items);
        });
    }
}
