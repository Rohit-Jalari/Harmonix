from spleeter.separator import Separator

def main():
    # Initialize the separator with 2 stems (vocals and accompaniment)
    separator = Separator('spleeter:2stems')

    # Separate the audio file
    separator.separate_to_file('uploads/testFull.mp3', 'outputs')

if __name__ == '__main__':
    main()
