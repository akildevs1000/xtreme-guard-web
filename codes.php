public function index(Request $request)
{
// return currentUser();
// generateMenuSlug();


// Get the authenticated user
$user = auth()->user();

// Ensure the user has multiple roles

// Retrieve permissions via roles
$permissions = $user->getPermissionsViaRoles();

// Check the permissions
// return $permissions;




$user = auth()->user();
$roles = $user->getPermissionsViaRoles();

[
'getRoleNames' => $roles = $user->roles, // Returns a collection
// get a list of all permissions directly assigned to the user
// 'getPermissionNames' => $user->getPermissionNames(), // collection of name strings
// 'permissions' => $user->permissions, // collection of permission objects
// // get all permissions for the user, either directly, or from roles, or from both
'getDirectPermissions' => $user->getDirectPermissions(),
// 'getPermissionsViaRoles' => $user->getPermissionsViaRoles(),

// 'getPermissionsViaRolesCount' => count($user->getPermissionsViaRoles()),
// 'getAllPermissionsCount' => count($user->getAllPermissions()),
// 'getAllPermissions' => $user->getAllPermissions(),

// get the names of the user's roles

];

// return $roles = $user->roles; // This retrieves all roles assigned to the user

// return $data = User::with('roles')->get();
// $model = User::query();

// if ($request->has('role') && $request->role != -1) {
// $model->whereHas('roles', function ($q) use ($request) {
// $q->where('name', $request->role);
// });
// }
// $result = $model->with('roles')->get();
$model = MenuHeader::query();

$menus = $model
->select(
'menu_headers.id as menuid',
'menu_headers.name1 as menuname1',
'md.id as menudetailid',
'md.name1 as menudetailname1',
'md.is_submenu_available',
'msd.id as submenudetailid',
'msd.name1 as submenudetailname1',
'md.sequence as menusequence',
'msd.sequence as submenusequence',
'msd.menu_slug as menu_sub_slug',
'md.menu_slug as menu_d_slug',
)
->leftJoin('menu_details as md', 'menu_headers.id', '=', 'md.menu_header_id')
->leftJoin('menu_sub_details as msd', 'md.id', '=', 'msd.menu_detail_id')->orderBy('md.id', 'asc')->get();


$menus_arr = [];

foreach ($menus as $menu) {
if ($menu->menuname1 == 'Dashboards') {
continue;
}

$menuItem = [
'moduleName' => $menu->menuname1,
'MenuId' => $menu->menuid,
'MenuDetailId' => $menu->menudetailid,
'MenuDetailSequence' => $menu->menusequence,
'perSlug' => $menu->menu_d_slug
];

if ($menu->is_submenu_available) {
$menuItem['menuName'] = $menu->submenudetailname1;
$menuItem['subMenuDetailId'] = $menu->submenudetailid;
$menuItem['isSubMenu'] = 1;
$menuItem['subMenuSequence'] = $menu->submenudetailid;
$menuItem['perSlug'] = $menu->menu_sub_slug;
} else {
$menuItem['menuName'] = $menu->menudetailname1;
$menuItem['subMenuDetailId'] = "";
$menuItem['perSlug'] = $menu->menu_d_slug;
}
$menus_arr[] = $menuItem;
}

// return $menus_arr;

$MenuList = collect($menus_arr)
->sortBy(function ($item) {
return [$item['MenuId'], $item['MenuDetailSequence'], $item['subMenuSequence'] ?? PHP_INT_MAX];
})->values()->all();

// $MenuList;

$dummyData = $this->generateDummyData(count($MenuList), 20);

// Merge the original data with the dummy data
// $MenuList = array_merge($MenuList, $dummyData);



if (request()->ajax()) {
return datatables()->of($MenuList)
->addColumn(
'form',
fn ($MenuList) =>
$MenuList['menuName'] .
'
<input type="hidden" id="MenuSlug" name="perSlug[]" value="' . $MenuList['perSlug'] . '">
<input type="hidden" id="ModuleName" name="MenuId[]" value="' . $MenuList['moduleName'] . '">
<input type="hidden" id="MenuName" name="MenuId[]" value="' . $MenuList['menuName'] . '">
<input type="hidden" id="MenuId" name="MenuId[]" value="' . $MenuList['MenuId'] . '">
<input type="hidden" id="MenuDetailId" name="MenuDetailId[]" value="' . $MenuList['MenuDetailId'] . '">
<input type="hidden" id="subMenuDetailId" name="subMenuDetailId[]" value="' . $MenuList['subMenuDetailId'] . '">
'
)
->addColumn(
'create',
fn ($MenuList) =>
'<input type="checkbox" name="create_chk_create[]" class="create-row-checkbox text-center form-check-input" value="' . $MenuList['perSlug'] . '-create" onclick="unselectAll(this,`create-row-checkbox`,`create-select-all-checkbox`)" />'
)
->addColumn(
'edit',
fn ($MenuList) =>
'<input type="checkbox" name="edit_chk_edit[]" class="edit-row-checkbox form-check-input text-center" value="' . $MenuList['perSlug'] . '-edit" onclick="unselectAll(this,`edit-row-checkbox`,`edit-select-all-checkbox`)" />'
)
->addColumn(
'view',
fn ($MenuList) =>
'<input type="checkbox" name="view_chk_view[]" class="view-row-checkbox form-check-input text-center" value="' . $MenuList['perSlug'] . '-view" onclick="unselectAll(this,`view-row-checkbox`,`view-select-all-checkbox`)" />'
)
->addColumn(
'delete',
fn ($MenuList) =>
'<input type="checkbox" name="delete_chk_delete[]" class="delete-row-checkbox form-check-input text-center" value="' . $MenuList['perSlug'] . '-delete" onclick="unselectAll(this,`delete-row-checkbox`,`delete-select-all-checkbox`)" />'
)
->rawColumns(['form', 'create', 'edit', 'view', 'delete'])
->addIndexColumn()
->make(true);
}


// return generateMenuSlug();
return view('pages/administration/permission/index', [
'roles' => Role::with('users:id,first_name,img')->get(),
'users' => User::get(['id', 'first_name', 'img']),
'userWithRoles' => User::with('roles')->get(),
]);
}


public function ensureIsNotRateLimited(): void
{
if (!RateLimiter::tooManyAttempts($this->throttleKey(), $this->maxAttempts())) {
return;
}

if ($this->loggedUserObj) {
// User::where('id', $this->loggedUserObj['id'])->update(['is_active' => 0]);
} else {
logger("User ID is null. No update performed.");
Log::info('User ID is null. No update performed');
}

Log::info($this->loggedUserObj);

event(new Lockout($this));

$seconds = RateLimiter::availableIn($this->throttleKey());

RateLimiter::increment($this->throttleKey());

// RateLimiter::increment('send-message:'.$user->id, amount: 5);

throw ValidationException::withMessages([
'username' => trans('auth.throttle', [
'seconds' => $seconds,
'minutes' => ceil($seconds / 60),
]),
]);
}

=====================
after deployee generate pdf its some error so we can use command to solve
// sudo chown -R www-data:www-data /var/www/oms/storage

this is for run queue on linux server.
// nohup php artisan queue:work > /dev/null 2>&1 &

this is chatgpt link about queue linux
https://chatgpt.com/share/679a1780-8b28-8001-872e-caf4157a906e
=====================

public function attachments(): array
{
// return [];
// $pdfPath = $this->attachedPath();

$orderId = $this->order['order_id'];
$pdfPath = storage_path("app/public/invoices/order-$orderId.pdf");

Log::info(1);

if (is_readable($pdfPath)) {
Log::info("The file is readable: $pdfPath");
} else {
Log::error("The file is not readable: $pdfPath");
}

if (file_exists($pdfPath)) {
Log::info($pdfPath);
return [
Attachment::fromPath($pdfPath),
];
}

// Log::info($pdfPath);
// return [
// Attachment::fromPath($pdfPath),
// ];
}

public function attachments(): array
{
return [];
// $pdfPath = $this->attachedPath();

$orderId = $this->order['order_id'];
// $pdfPath = storage_path("app/public/invoices/order-$orderId.pdf");
$pdfPath = storage_path("app/public/lowstock/low-stock-2024-10-23.pdf");

Log::info(1);

if (is_readable($pdfPath)) {
Log::info("The file is readable: $pdfPath");
} else {
Log::error("The file is not readable: $pdfPath");
}

// if (file_exists($pdfPath)) {
// Log::info($pdfPath);
// return [
// Attachment::fromPath($pdfPath),
// ];
// }

try {
$attachment = Attachment::fromPath($pdfPath);
Log::info("Attachment created successfully.");
return [$attachment];
} catch (\Exception $e) {
Log::error("Failed to create attachment: " . $e->getMessage());
return [];
}

// Log::info($pdfPath);
// return [
// Attachment::fromPath($pdfPath),
// ];
}

==============================
public function logMessage($message, $logFile = 'log.log')
{
$logDir = 'logs';

if (!is_dir($logDir)) {
mkdir($logDir, 0777, true);
}

$date = date('Y-m-d H:i:s');
$formattedMessage = "[$date] $message" . PHP_EOL;

file_put_contents("$logDir/$logFile", $formattedMessage, FILE_APPEND);
}
==============================


==============================
function logMessage($message, $title = 'INFO', $logFile = 'my-php-log.log')
{
$logDir = storage_path('logs/phplog');

if (!is_dir($logDir)) {
mkdir($logDir, 0777, true);
}

// Capture visitor details
$ipAddress = $_SERVER['REMOTE_ADDR'] ?? 'Unknown IP';
$userAgent = $_SERVER['HTTP_USER_AGENT'] ?? 'Unknown User Agent';
$requestedUrl = $_SERVER['REQUEST_URI'] ?? 'Unknown URL';

// Detect device type
if (preg_match('/mobile/i', $userAgent)) {
$deviceType = 'Mobile';
} elseif (preg_match('/tablet|ipad/i', $userAgent)) {
$deviceType = 'Tablet';
} else {
$deviceType = 'Desktop';
}

// Detect operating system
if (preg_match('/Windows/i', $userAgent)) {
$os = 'Windows';
} elseif (preg_match('/Mac/i', $userAgent)) {
$os = 'MacOS';
} elseif (preg_match('/Linux/i', $userAgent)) {
$os = 'Linux';
} elseif (preg_match('/Android/i', $userAgent)) {
$os = 'Android';
} elseif (preg_match('/iPhone|iPad/i', $userAgent)) {
$os = 'iOS';
} else {
$os = 'Unknown OS';
}

// Detect browser
if (preg_match('/Chrome/i', $userAgent)) {
$browser = 'Chrome';
} elseif (preg_match('/Firefox/i', $userAgent)) {
$browser = 'Firefox';
} elseif (preg_match('/Safari/i', $userAgent) && !preg_match('/Chrome/i', $userAgent)) {
$browser = 'Safari';
} elseif (preg_match('/Edge/i', $userAgent)) {
$browser = 'Edge';
} elseif (preg_match('/MSIE|Trident/i', $userAgent)) {
$browser = 'Internet Explorer';
} else {
$browser = 'Unknown Browser';
}

// Current date and time
$date = date('Y-m-d H:i:s');

// Prepare the log message
$formattedMessage = "[$date] $title: $message | IP: $ipAddress | URL: $requestedUrl | User Agent: $userAgent | Device: $deviceType | Browser: $browser | OS: $os" . PHP_EOL;

// Write to the log file
file_put_contents("$logDir/$logFile", $formattedMessage, FILE_APPEND);

return 'done';
}

==============================
