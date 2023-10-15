<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function getValidatorInstance()
    {
        $old_year = $this->input('old_year');
        $old_month = $this->input('old_month');
        $old_day = $this->input('old_day');
        $birth_day = $old_year .'-'. $old_month .'-'. $old_day;

        $this->merge([
            'birth_day' => $birth_day,
        ]);

        return parent::getValidatorInstance();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'over_name' => ['required','string' ,'max:10'],
            'under_name' => ['required','string' ,'max:10'],
            'over_name_kana' => ['required','string' ,'max:30','regex:/^[ア-ン゛゜ァ-ォャ-ョー]+$/u'],
            'under_name_kana' => ['required','string' ,'max:30','regex:/^[ア-ン゛゜ァ-ォャ-ョー]+$/u'],
            'mail_address' => ['required','max:100','email','unique:users'],
            'sex' => ['required','in:1,2,3'],
            'birth_day' =>['required','after:1999-12-31','before:tomorrow','date'],
            'role' => ['required','in:1,2,3,4'],
            'password' => ['required','min:8','max:30','confirmed'],

        ];
    }
    public function messages() {
        return [
            'over_name.required'=> '名前が未入力です',
            'under_name.required'=> '名前が未入力です',
            'over_name_kana.required' => 'フリガナが未入力です。',
            'over_name_kana.regex' => 'カタカナで入力してください。',
            'under_name_kana.required' => 'フリガナが未入力です。',
            'under_name_kana.regex' => 'カタカナで入力してください。',
            'mail_address.required' => 'メールアドレスが未入力です。',
            'mail_address.email' => 'メール形式で入力してください。',
            'mail_address.unique' => 'このメールアドレスは登録済みです。',
            'sex.required' => '性別が未入力です。',
            'birth_day.required' => '誕生日が未入力です。',
            'birth_day.date' => '正しい生年月日を入力してください。',
            'birth_day.after' => '2000年1月1日以降の日付を入力してください。',
            'birth_day.before' => '今日より前の日付を入力してください。',
            'role.required' => '役職が未入力です。',
            'password.required' => 'パスワードが未入力です。',
            'password.min' => 'パスワードは8文字以上で設定してください。',
            'password.confirmed' => 'パスワードが異なります。',
        ];
    }
}
