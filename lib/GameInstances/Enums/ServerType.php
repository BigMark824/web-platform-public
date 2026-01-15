<?php

namespace GooberBlox\GameInstances\Enums;

enum ServerType
{
    const WebServer = 1;
    const ThumbServer = 2;
    const Gameserver = 3;
    const MixServer = 4; // can handle thumbnails and games
}
