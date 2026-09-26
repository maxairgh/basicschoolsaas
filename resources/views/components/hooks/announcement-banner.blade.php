 @if(session()->has('announcement'))
 <div  icon-color="info" 
        style="background-color: #f59e0b; color: white; padding: 12px; margin-top: 10px; display: flex; align-items: center; gap: 12px; border-radius: 8px; position: relative;">
        
        <!-- Megaphone Icon -->
        <div style="width: 20px; height: 20px; color: white;">
        @svg('heroicon-o-megaphone')
        </div>

        <!-- Announcement Content -->
        <p style="flex: 1; font-weight: 200; margin: 0;">{{ session('announcement') }}</p>

        <!-- Close Button -->
        <span onclick="this.parentElement.style.display='none'" 
            style="background: none; border: none; color: white; font-size: 18px; font-weight: bold; cursor: pointer;">
            ✖
        </span>
    </div>
@endif