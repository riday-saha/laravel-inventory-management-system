namespace App\Exports;

use App\Models\Attendance;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AttendanceExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        // Customize this query to fetch the attendance data you want to export
        return Attendance::all();
    }

    public function headings(): array
    {
        return [
            
            'Employee Name',
            'Date',
            'Status',
        ];
    }
}
