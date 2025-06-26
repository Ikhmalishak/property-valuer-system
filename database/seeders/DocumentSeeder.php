<?namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Document;
use Illuminate\Support\Str;

class DocumentSeeder extends Seeder
{
    public function run(): void
    {
        $types = ['pdf', 'docx', 'xlsx'];
        $categories = ['Invoice', 'Report', 'Contract', 'Manual'];

        for ($i = 1; $i <= 20; $i++) {
            $type = $types[array_rand($types)];
            $category = $categories[array_rand($categories)];
            $fileName = "Sample_File_{$i}." . $type;
            $filePath = "/
            Document::create([
                'file_name' => $fileName,
                'file_path' => $filePath,
                'file_type' => $type,
                'category' => $category,
                'size' => rand(100_000, 5_000_000), // ~100KB to 5MB
            ]);
        }
    }
}
