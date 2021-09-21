<?php

namespace App\Http\Controllers\Grades;

use App\Http\Controllers\Controller;

use App\Http\Requests\StoreGradesRequest;
use App\Models\Classroom;
use App\Models\Grade;
use CodeZero\UniqueTranslation\UniqueTranslationRule;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class GradeController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $Grades = Grade::all();
        return view('pages.Grades.Grades', compact('Grades'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(StoreGradesRequest $request)
    {
//        if (Grade::where('Name->ar', $request->Name)->orWhere('Name->en', $request->Name_en)->exists()) {
//            return redirect()->back()->withErrors(trans('Grades_trans.exists'));
//        }
        try {

            $Grade = new Grade();
//      $tr = [
//        'en'=> $request -> Name_en,
//          'ar'=>$request ->Name,
//      ];
//      $Grade->setTranslations('Name',$tr);

            $Grade->Name = ['en' => $request->Name_en, 'ar' => $request->Name,];
            $Grade->Notes = ['en' => $request->Notes_en, 'ar' => $request->Notes,];
            $Grade->save();
            toastr()->success(__('messages.success'));

            return redirect()->route('Grades.index');

        } catch (\Exception $ex) {
            //عرض  ايرور  لارفيل
            // return redirect()->back()->withErrors(['error' => $ex ->getMessage()]);
            return redirect()->back()->withErrors(['error' => $ex->getMessage()]);

        }

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     * @return Response
     */
    public function update(StoreGradesRequest $request)
    {
        try {

            $validated = $request->validated();
            $Grades = Grade::findOrFail($request->id);//ابحث  عن الايدي
            $Grades->update([//التعديل
                $Grades->Name = ['ar' => $request->Name, 'en' => $request->Name_en],
                $Grades->Notes = ['en' => $request->Notes_en, 'ar' => $request->Notes,],
            ]);
            toastr()->success(trans('messages.Update'));
            return redirect()->route('Grades.index');
        } catch
        (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
//    public function destroy(Request $request) // حذف جميع العناصر
//    {
//        Grade::findOrFail($request->id)->delete();
//        toastr()->error(trans('messages.Delete'));
//        return redirect()->route('Grades.index');
//
//    }

    public function destroy(Request $request)    // الحذف مع التئكيد ان لايوجد عناصر مشتركه في تيبول Classroom
    {
        $MyClass_id = Classroom::where('Grade_id', $request->id)->pluck('Grade_id'); //دور في تيبول Classroom علي Grade_id

        if ($MyClass_id->count() == 0) { //لو  صفر يمكن  حذف المرحله

            $Grades = Grade::findOrFail($request->id)->delete();
            toastr()->error(trans('messages.Delete'));
            return redirect()->route('Grades.index');
        } else { //لو اكبر صفر لايمكن  حذف المرحله

            toastr()->error(trans('Grades_trans.delete_Grade_Error'));
            return redirect()->route('Grades.index');

        }


    }


}

?>
