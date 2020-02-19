# Building



    Download and unzip OpenSim: http://opensimulator.org/viewgit/?a=shortlog&p=opensim

    Rename opensimxxx-xxx-xxxxx to opensim

    Copy Directory folder /bin to /opensim

    Copy Directory folder /ThirdParty to /opensim

    Add money-prebuild.xml to prebuild.xml:

    ./runprebuild.sh

    msbuild /p:Configuration=Release

    Edit MoneyServer.ini with your data.

    Add OpenSim.ini.sample to the OpenSim.ini.

