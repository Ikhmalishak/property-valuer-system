<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'file_name',
        'file_type',
        'file_path',
    ];

    protected $casts = [
        'year' => 'integer',
        'download_count' => 'integer',
    ];

    // Scope for active documents
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Scope for filtering by category
    public function scopeByCategory($query, $category)
    {
        if ($category && $category !== 'Semua') {
            return $query->where('category', $category);
        }
        return $query;
    }

    // Scope for filtering by year
    public function scopeByYear($query, $year)
    {
        if ($year) {
            return $query->where('year', $year);
        }
        return $query;
    }

    // Scope for searching
    public function scopeSearch($query, $search)
    {
        if ($search) {
            return $query->where('title', 'LIKE', "%{$search}%")
                        ->orWhere('description', 'LIKE', "%{$search}%");
        }
        return $query;
    }

    // Get formatted file size
    public function getFormattedFileSizeAttribute()
    {
        $bytes = floatval($this->file_size);
        $units = ['B', 'KB', 'MB', 'GB'];
        
        for ($i = 0; $bytes > 1024 && $i < count($units) - 1; $i++) {
            $bytes /= 1024;
        }
        
        return round($bytes, 1) . ' ' . $units[$i];
    }

    // Increment download count
    public function incrementDownload()
    {
        $this->increment('download_count');
    }
}