# Introduction

This is the API documentation for AA작업.

<aside>
    <strong>Base URL</strong>: <code>http://localhost</code>
</aside>

Welcome to the API documentation for {app_name}. This documentation provides detailed information about the API endpoints and how to use them.
안녕하세요 api 문서입니다.

# API 문서작성시 표기 방식

우리 API는 다음과 같은 응답 코드를 사용합니다.  
추후 필요한 응답코드들은 문의 해주시면 작성하겠습니다.  
사용법은 아래와 같습니다.  



@response status=200 scenario="성공" {성공!}  
@response status=401 scenario="인증 실패" {인증 실패!}  
@response status=404 scenario="페이지 없음" {페이지 없음!}  
@response status=403 scenario="권한 없음" {권한 없음!}  
@response status=500 scenario="서버 오류" {서버 오류!}  
@response status=403 scenario="권한 없음" {권한 없음!}  



    컨트롤러 문서 작성 예시
    /**
    * @return \Illuminate\View\View
    * @response status=401 scenario="토큰 없음" {
    *  "message": "로그인이 필요한 서비스입니다.",
    *  "code": "UNAUTHORIZED"
    * }
    * /
    public function index()  {
        return view('index');
    }

---------------------------------------------------------------------  

    * 응답코드 예시 문서 작성 예시
    * @response status=200 scenario="성공" {
    *  "id": 1,
    *  "name": "John Doe"
    * }
    * @response status=401 scenario="인증 실패" {
    *  "message": "로그인이 필요한 서비스입니다.",
    *  "code": "UNAUTHORIZED"
    * }
    * @response status=404 scenario="사용자 없음" {
    *  "message": "User not found"
    * }

# API 반환 타입 가이드

API 메서드 문서화 시 다음과 같은 반환 타입을 사용할 수 있습니다. 각 타입에 따라 적절한 `@return` 태그를 사용하세요.  
추후 오른쪽 입력 뷰어에 작성예시 순차적으로 추가할 예정입니다.

    웹뷰 사용 예시 현재: @return \Illuminate\View\View 사용중
    /**
    * @return \Illuminate\View\View <----- 웹 뷰 반환 입력예시 화살표는 무시해주세요
    * @response status=401 scenario="토큰 없음" {
    *  "message": "로그인이 필요한 서비스입니다.",
    *  "code": "UNAUTHORIZED"
    * }
    * /
    public function index()  {
        return view('index');
    }

## 웹 뷰 반환

웹 페이지를 렌더링하는 메서드에 사용합니다.  
/
@return \Illuminate\View\View
/

    * @return \Illuminate\View\View
    public function index()  {
        return view('index');
    }

## JSON 응답 반환

API 엔드포인트에서 JSON 데이터를 반환할 때 사용합니다.  
/
@return \Illuminate\Http\JsonResponse
/

## 리다이렉트 반환

다른 URL로 리다이렉트할 때 사용합니다.  
/
@return \Illuminate\Http\RedirectResponse
/

## 파일 다운로드 반환

파일을 다운로드할 때 사용합니다.  
/
@return \Symfony\Component\HttpFoundation\BinaryFileResponse
/

## 스트림 응답 반환

대용량 데이터를 스트리밍할 때 사용합니다.  
/
@return \Symfony\Component\HttpFoundation\StreamedResponse
/

## 일반 응답 반환

다양한 형태의 HTTP 응답을 반환할 때 사용합니다.  
/
@return \Illuminate\Http\Response
/

## 컬렉션 반환

데이터 컬렉션을 반환할 때 사용합니다.  
/
@return \Illuminate\Support\Collection
/

## 페이지네이션 결과 반환

페이지네이션된 결과를 반환할 때 사용합니다.  
/
@return \Illuminate\Pagination\LengthAwarePaginator
/

## 모델 인스턴스 반환

단일 Eloquent 모델 인스턴스를 반환할 때 사용합니다.  
/
@return \App\Models\User
/

각 API 메서드에 적절한 반환 타입을 명시하여 문서의 정확성과 가독성을 높일 수 있습니다.  
그래도 모르시면 문의해주세요. 